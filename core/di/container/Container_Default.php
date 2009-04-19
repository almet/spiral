<?php
namespace spiral\core\di\container;
use \spiral\core\di\schema\Schema,
	\spiral\core\di\schema\Method,
	\spiral\core\di\schema\exception\UnknownMethod,
	\spiral\core\loader\Loader,
	\spiral\core\loader\loader_Default;

/**
 * Default Container implementation
 * 
 * Use autoload of classes by default, if no Loader is specified at 
 * construction time.
 *
 * See the interface for further information / documentation.
 *  
 * @author  	Alexis Métaireau    16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class Container_Default implements Container
{
    /**
     * The schema object
     *
     * @var Schema
     */
    protected $_schema;
    
    /**
     * the loader object
     *
     * @var	Loader
     */
    protected $_loader  = null;
    
    public function __construct(Schema $schema, Loader $loader = null){
        $this->_schema = $schema;
        if ($loader != null){
        	$this->_loader = $loader;
        }
    }

    /**
     * Call the given method
     *
     * @param   mixed   $class class or Service to call
     * @param   string  $methodName
     * @param   array   $args
     */
    protected function _callMethod($class, $methodName, $arguments){
    	$this->_load($class);
    	
        if (method_exists($class, $methodName) && is_callable(array($class, $methodName))){
            call_user_func_array(array($class, $methodName), $arguments);
        }
    }
    
    /**
     * Call the loader if defined
     *
     * @return 	void
     */
    protected function _load($className){
    	if ($this->_loader != null){
    		$this->_loader->load($className);
    	}
    }

    /**
     * Iterate all arguments and do some stuff
     * 
     * @param   array   $args
	 * @param	object	$object
     * @return  array
     */
    protected function _processMethodArguments(array $arguments, $object = null){
        $processedArguments = array();
		// 
        foreach($arguments as $arg){
            if($arg[0] == Schema::ACTIVE_SERVICE && $object != null){
                $processedArguments[] = $object;
            } elseif($arg[1] == Method::ARG_IS_SERVICE){
                $processedArguments[] = $this->getService($arg[0]);
            } else {
                $processedArguments[] = $arg[0];
            }
        }
        return $processedArguments;
    }

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
    
    public function getService($key){

        // get the registred service object
        $service = $this->_schema->getService($key);
		$className = $service->getClassName();

		$this->_load($className);
        
        // build the object
        try{
			$constructor = $service->getMethod('__construct');
            // build the object
            $args = $this->_processMethodArguments($constructor->getArguments());

            $params = '';
             for ($i = 0; $i < count($args); $i++) {
                   $params .= '$args['.$i.'],';
             }

             $params = rtrim($params,',');
             $object = eval("return new $className($params);");
			 
		// if no constructer is defined in the schema, just build the object
        } catch(UnknownMethod $e) {
            $object = new $className();
        }
		
        $this->injectMethods($service->getRegistredMethods(), $object);
        
        return $object;
    }

    public function __get($key){
        return $this->getService($key);
    }
}
?>
