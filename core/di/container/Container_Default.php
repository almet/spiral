<?php
namespace spiral\core\di;

/**
 * the container is the class that store all
 * initialized objects, and can call the schema 
 * to resolve dependencies.
 *
 * Exemple of use
 * <code>
 * // prented here that we have already build our schema object as $schema
 * $container = new Container($schema);
 * // call the 'get' method, and, that's all folks !
 * $obj = $container->get('id');
 * // 'get' can be replaced by using the magix __get() method:
 * $obj = $container->id;
 * </code>
 */
class Container_Default implements Container
{
    /**
     * The schema object
     *
     * @var ISchema
     */
    protected $_schema;
    
    /**
     * set the schema object given in parameter
     *
     * @param   Ischema $schema
     * @return  void
     */
    public function __construct(Schema $schema){
        $this->_schema = $schema;
    }
    
    /**
     * Magic method get.
     *
     * Alias of get()
     */
    public function __get($key){
        return $this->getService($key);
    }

    /**
     * Call the given method, and check if all is good
     *
     * @param   mixed   $class class or Service to call
     * @param   string  $methodName
     * @param   array   $args
     */
    protected function _callMethod($class, $methodName, $args){
        if (method_exists($class, $methodName) && is_callable(array($class, $methodName))){
            call_user_func_array(array($class, $methodName), $args);
        }
    }

    /**
     * Filter the arg array and resolve dependencies if needed
     * 
     * @param   array   $args
     * @return  array
     */
    protected function _filterArgArray($initialArgs, $object = null){
        $args = array();
        foreach($initialArgs as $arg){
            if($arg[0] == Schema::ACTIVE_SERVICE && $object != null){
                $args[] = $object;
            } elseif($arg[0] == Method::ARG_IS_SERVICE){
                $args[] = $this->getService($arg[1]);
            } else {
                $args[] = $arg[0];
            }
        }
        return $args;
    }

    /**
     * Call all dynamic registered methods
     *
     * TODO: Find a better way to check if a method is static or not
     *
     * @param   array   $methods    methods to call
     * @param   mixed   $object object to act on
     * @return  void
     */
    public function callMethods($methods, $object){
        foreach ($methods as $method){
            $methodName = $method->getMethod();
            if ($methodName != '__construct'){
                if (get_class($method) == 'Spiral\Core\Di\Service\Method'){
                    $this->_callMethod($object, $methodName, $this->_filterArgArray($method->getArguments(), $object));
                } elseif (get_class($method) == 'Spiral\Core\Di\Service\MethodStatic'){
                    $this->_callMethod($method->getClass(), $methodName,  $this->_filterArgArray($method->getArguments(), $object));
                }
            }
        }
        return $object;
    }
    
    /**
     * Resolve all dependencies and return the 
     * configured object
     *
     * @param   String  $key
     * @return  mixed
     */
    public function getService($key){

        // first, get the registred configuration object
        $service = $this->_schema->getElement($key);

        // get the constructor method
        if ($constructor = $service->getMethod('__construct')){
            // build the object
            $args = $this->_filterArgArray($constructor->getArguments());

            $params = '';
             for ($i = 0; $i < count($args); $i++) {
                   $params .= '$args['.$i.'],';
             }

             $params = rtrim($params,',');
             $className = $service->getClassName();
             $object = eval("return new $className($params);");
        } else {
            $className = $service->getClassName();
            $object = new $className();
        }
     
        /*$object = eval("return new $className($params);");

        // FIXME: Use reflexion ?
        $rC = new ReflectionClass($className);
        $object = $rC->newInstanceArgs($constructor->getArguments());
        */
        // call injected methods
        $this->callMethods($service->getMethodCollection()->getElements(), $object);
        
        return $object;
    }
}
?>
