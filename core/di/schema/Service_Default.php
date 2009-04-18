<?php
namespace Spiral\Core\Di;

/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * @author      ametaireau 30 mars 2009
 */

class Service_Default implements Service {

    /**
     * Store the name of the Service (ie. the key)
     *
     * @var String
     */
    protected $_serviceName = null;
    
    /**
     * Store the classname of the Service
     *
     * @var String
     */
    protected $_className  = null;
    
    /**
     * the array representing the set of methods avalaible for this Service
     *
     * @var Array
     */
    protected $_registredMethods = array();
 
    public function __construct($service, $class){
        $this->_serviceName = $service;
        $this->_className  = $class;
    }

    public function registerMethod($name, Method $method){
		$this->_registredMethods[$name] = $method;
	}

    public function getMethod($name){
		if (!array_key_exists($name, $this->_registredMethods)){
			throw new exception\UnknownMethod($name);
		}
		return $this->_registredMethods[$name];
	}

    public function getRegistredMethods(){
		$this->_registredMethods;
	}
    
    public function getClassName(){
        return $this->_className;
    }

	public function getServiceName(){
		return $this->_serviceName;
	}
}

?>