<?php
namespace Spiral\Core\Di;
use \Spiral\Core\Transfer\Collection\Collection as Collection;

/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * @package     Spiral\Core\Di
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
     * the collection representing the set of methods avalaible for this Service
     *
     * @var ICollection
     */
    protected $_methodCollection = null;
    
    /**
     * Store the last called or defined methods
     * 
     * @var array
     */
    protected $_activeMethods = array();
    
    /**
     * Store the Service identifier and class
     *
     * @param   string  $Service name of the Service
     * @param   string  $class  name of the class
     * @return  void
     */
    public function __construct($service, $class){
        $this->_serviceName = $service;
        $this->_className  = $class;
        $this->_methodCollection = new Collection();
    }
    
    /** 
     * Add a method to the collection
     * 
     * @param String            $name
     * @param Service\Method    $object   the method object
     */
    protected function _addMethod($name, $object){
        $this->_methodCollection->setElement($name, $object);
    }
    
    /**
     * Return an Service\Method Service.
     * If this method already exists, reltreive informations from Collection
     * else, create a new one.
     *
     * @param   String  name name of the method
     * @param   String  $class  class name for static methods
     * @return  Service\Method
     */
    protected function _getMethod($name, $class = null){
        if ($this->_methodCollection->hasElement($method)){
            $method = $this->_methodCollection->getElement($method);
        } else {
            if ($class == null){
                $method = new Service\Method($name);
            } else {
                $method = new Service\MethodStatic($name, $class);
            }
            
            $this->_addMethod($name, $method);
        }
        return $method;
    }
    
    /**
     * Set the method to call
     * 
     * @param   string  $methodName
     * @return  Service
     */
    public function call($methodName, $class = null){
        if (is_array($methodName)){
            foreach($methodName as $name){
                // set it as active Service
                $this->_activeMethods[$name] = $this->_getMethod($name, $class);
            }
        } else {
             $this->_activeMethods = array($this->_getMethod($methodName, $class));
        }
        return $this;
    }
    
    /** 
     * Add an argument to all active methods
     *
     * @param   mixed   $name       name of the argument
     * @param   Bool    $asService  set if argument is a service id or not
     * @return Service
     */
    public function addArgument($arg, $asService){
        foreach($this->_activeMethods as $method){
            $method->addArgument($arg, $asService);
        }
        return $this;
    }
    
    /** 
     * Return the given method
     * 
     * @param   string  $methodName
     * @return  Service\Method
     */
    public function getMethod($methodName){
        return $this->_methodCollection->getElement($methodName);
    }

    /**
     * return the internal collection of methods
     * 
     * @return Collection
     */
    public function getMethodCollection(){
        return $this->_methodCollection;
    }
    
    /** 
     * Return the classname of Service
     * 
     * @return String
     */
    public function getClassName(){
        return $this->_className;
    }
}

?>
