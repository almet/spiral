<?php

/**
 * Default Container implementation
 *
 * Use autoload of classes by default, if no Loader is specified at
 * construction time.
 *
 * See the interface for further information / documentation.
 *
 * @package     SpiralDi
 * @subpackage  Container
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class SpiralDi_Container_Default implements SpiralDi_Container
{

    /**
     * The schema object
     *
     * @var	SpiralDi_Schema
     */
    protected $_schema;

    /**
     * the loader object
     *
     * @var	SpiralDi_Loader
     */
    protected $_loader  = null;

    /**
     * Shared services
     *
     * @var array
     */
    protected $_sharedServices = array();

    /**
     * set the schema object given in parameter
     *
     * @param	SpiralDi_Schema     $schema
     * @param	SpiralDi_Loader     $loader
     * @return	void
     */
    public function __construct(SpiralDi_Schema $schema, SpiralDi_Loader $loader = null){
        $this->_schema = $schema;
        if ($loader != null){
            $this->_loader = $loader;
        }
    }

    /**
     * Call the given method
     *
     * @param	mixed	$class	class or Service to call
     * @param	string	$methodName
     * @param	array	$args
     * @return
     */
    protected function _callMethod($class, $methodName, $arguments){
        $this->_load($class);

        if (method_exists($class, $methodName) && is_callable(array($class, $methodName))){
            $object = call_user_func_array(array($class, $methodName), $arguments);
        }

        return $object;
    }

    /**
     * Call the loader if defined
     *
     * @return	void
     */
    protected function _load($className){
        if ($this->_loader != null){
            $this->_loader->load($className);
        }
    }

    /**
     * Iterate all arguments and do some stuff
     *
     * @param	array 	$args
     * @param	object	$object
     * @return	array
     */
    protected function _processMethodArguments(array $arguments, $object = null){
        $processedArguments = array();
        
        foreach($arguments as $arg){
            if (!$arg instanceof SpiralDi_Schema_Argument){
                throw new SpiralDi_Schema_Exception_InvalidArgument(get_class($arg).' must implements the SpiralDi_Schema_Argument interface');
            }
            switch(get_class($arg)){
                case 'SpiralDi_Schema_Argument_Default':
                     $processedArguments[] = $arg->getValue();
                break;
                
                case 'SpiralDi_Schema_Argument_ActiveService':
                    if ($object != null){
                        $processedArguments[] = $object;
                    }
                break;

                case 'SpiralDi_Schema_Argument_ServiceRef':
                    $processedArguments[] = $this->getService($arg->getValue());
                break;

                case 'SpiralDi_Schema_Argument_UseRef':
                     $serviceName = $arg->getRef();
                     $service = $this->getService($serviceName);
                     $factoryMethod = $arg->getFactoryMethod();
                     $attributes = $arg->getValue();

                     if(!empty($factoryMethod)){
                         $processedArguments[] = $service->$factoryMethod($attributes);
                     }else{
                         $processedArguments[] = $service->$attributes;
                     }
                break;

                case 'SpiralDi_Schema_Argument_Container':
                    $processedArguments[] = $this;
                break;
            }
        }
        return $processedArguments;
    }

    /**
     * Call all dynamic added methods
     *
     * @param	array	$methods	methods to call
     * @param	mixed	$object 	object to act on
     * @return	void
     */
    public function injectMethods($methods, $object){
        foreach ($methods as $method){
            $methodName = $method->getName();
            if ($methodName != '__construct'){
                if ($method->isStatic()){
                    $this->_callMethod(
                    $method->getClass(), $methodName,
                    $this->_processMethodArguments($method->getArguments(), $object)
                    );
                } else{
                    $this->_callMethod(
                    $object, $methodName,
                    $this->_processMethodArguments($method->getArguments(), $object)
                    );
                }
            }
        }
        return $object;
    }

    /**
     * Resolve all dependencies and return the
     * injected service object
     *
     * @param	string	$key
     * @return	mixed
     */
    public function getService($key){

        if (isset($this->_sharedServices[$key]))
        {
            return $this->_sharedServices[$key];
        }

        // get the registred service object
        $service = $this->_schema->getService($key);

        $className = $service->getClassName();

        $this->_load($className);

        if ($service instanceOf SpiralDi_Schema_Service_Factory){
            $methods = $service->getMethods();
            $method = array_shift($methods);
            $args = $this->_processMethodArguments($method->getArguments());

            $return = $this->_callMethod($service->getClassName(), $method->getName(), $args);

            if ($service->isSingleton()){
                $this->_sharedServices[$key] = $return;
            }

            return $return;
        }

        // build the object
        try{
            $constructor = $service->getMethod('__construct');
            // build the object
            $args = $this->_processMethodArguments($constructor->getArguments());

            $params = '';
            for ($i = 0; $i < count($args); $i++) {
                $params .= '$args['.$i.'],';
            }
            // really really ugly eval here. Should be replaced by some reflexion
            $params = rtrim($params,',');
            $object = eval("return new $className($params);");

            // if no constructor is defined in the schema, just build the object
        } catch(SpiralDi_Schema_Exception_UnknownMethod $e) {
            $object = new $className();
        }

        $this->injectMethods($service->getMethods(), $object);

        // For ContainerAware objects
        if($object instanceof SpiralDi_ContainerAware)
        {
            $object->setDiContainer($this);
        }

        if($service->isSingleton())
        {
            $this->_sharedServices[$key] = $object;
        }

        return $object;
    }

    /**
     * Magic method get.
     *
     * Alias of getService()
     */
    public function __get($key){
        return $this->getService($key);
    }

    /**
     * Directly add an object into the Container (bypassing the Schema)
     *
     * Overwrite the Schema configuration
     *
     * @param   string  $key
     * @param   object  $value
     */
    public function setService($key, $service)
    {
        if (!is_object($service))
        {
            throw new SpiralDi_Container_Exception('The service '.$key.' must be an object');
        }
        $this->_sharedServices[$key] = $service;
    }

    /**
     * Magic method set.
     *
     * Alias of setService()
     * @param   string  $key
     * @param   object  $service
     */
    public function __set($key, $service)
    {
        $this->setService($key, $service);
    }

    /**
     * Magic method isset.
     * 
     * @param   string  $key
     * @return  boolean
     */
    public function __isset ($key)
    {
    	return isset($this->_sharedServices[$key]) || $this->_schema->hasService($key);
    }
}
?>
