<?php
namespace \Spiral\Framework\DI\Container;
use \Spiral\Framework\DI\Schema\Schema;
use \Spiral\Framework\Bootstrap\Loader;
use \Spiral\Framework\DI\Schema\FactoryService;
use \Spiral\Framework\DI\Schema\Exception\UnknownMethodException;
use \Spiral\Framework\DI\ContainerAware;

/**
 * Default Container implementation
 *
 * Use autoload of classes by default, if no Loader is specified at
 * construction time.
 *
 * See the interface for further information / documentation.
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class DefaultContainer implements Container
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
     * @param	Schema     $schema
     * @param	Loader     $loader
     * @return	void
     */
    public function __construct(Schema $schema, Loader $loader = null){
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
                throw new SpiralDi_Schema_Exception_InvalidArgument(get_class($arg).' must implements the Spiral\Framework\Di\Schema\Argument interface');
            }
            switch(get_class($arg)){
                case '\Spiral\Framework\Di\Schema\DefaultArgument':
                     $processedArguments[] = $arg->getValue();
                break;
                
                case '\Spiral\Framework\Di\Schema\ActiveServiceArgument':
                    if ($object != null){
                        $processedArguments[] = $object;
                    }
                break;

                case '\Spiral\Framework\Di\Schema\ServiceRefArgument':
                    $processedArguments[] = $this->getService($arg->getValue());
                break;

                case '\Spiral\Framework\Di\Schema\UseRefArgument':
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

                case '\Spiral\Framework\Di\Schema\ContainerArgument':
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

        if ($service instanceOf FactoryService){
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
        } catch(UnknownMethodException $e) {
            $object = new $className();
        }

        $this->injectMethods($service->getMethods(), $object);

        // For ContainerAware objects
        if($object instanceof ContainerAware)
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
            throw new Exception('Service '.$key.' must be an object');
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
