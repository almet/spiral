<?php
namespace Spiral\Core\Di;
/**
 * DiObject allow to store the state and the configuration of 
 * the representation of object and classes we want to inject
 *
 * @package     Spiral\Core\Di
 * @author      ametaireau 30 mars 2009
 */

class Object {

    /**
     * Store the name of the object (ie. the key)
     *
     * @var String
     */
    protected $_objectName = null;
    
    /**
     * Store the classname of the object
     *
     * @var String
     */
    protected $_className  = null;
    
    /**
     * the collection representing the set of methods avalaible for this object
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
     * Store the object identifier and class
     *
     * @param   string  $object name of the object
     * @param   string  $class  name of the class
     * @return  void
     */
    public function __construct($object, $class){
        $this->_objectName = $object;
        $this->_className  = $class;
        $this->_methodCollection = new \Spiral\Core\Transfer\Collection\Base();
    }
    
    /** 
     * Add a method to the collection
     * 
     * @param String        $methodName
     * @param Object\Method $methodObject   the method object
     */
    protected function _addMethod($methodName, $methodObject){
        $this->_methodCollection->setElement($methodName, $methodObject);
    }
    
    /**
     * Return a Object\Method object.
     * If this method already exists, reltreive informations from Collection
     * else, create a new one.
     *
     * @param   String  $method name of the method
     * @return  Object\Method
     */
    protected function _getMethod($method){
        if ($this->_methodCollection->hasElement($method)){
            $methodObject = $this->_methodCollection->getElement($method);
        } else {
            $methodObject = new Object\Method($method);
            $this->_addMethod($method, $methodObject);
        }
        return $methodObject;
    }
    
    /**
     * Set the method to inject
     * 
     * @param   string  $method
     * @return  Object
     */
    public function inject($method){
        if (is_array($method)){
            foreach($method as $m){
                // set it as active object
                $this->_activeMethods[$m] = $this->_getMethod($m);   
            }
        } else {
             $this->_activeMethods = array($this->_getMethod($method));
        }
        return $this;
    }
    
    /** 
     * Add an argument to all active methods
     *
     * @param   mixed   $name   name of the argument
     * @return Object
     */
    public function addArgument($arg){
        foreach($this->_activeMethods as $method){
            $method->addArgument($arg);
        }
        return $this;
    }
    
    /** 
     * Return the given method
     * 
     * @param   string  $methodName
     * @return  Object\Method
     */
    public function getMethod($methodName){
        return $this->_methodCollection->getElement($methodName);
    }
    
    /** 
     * Return the classname of object
     * 
     * @return String
     */
    public function getClassName(){
        return $this->_className;
    }
    
    /**
     * Call all dynamic registered methods 
     *
     * @param   mixed   $object object to act on
     * @return  void
     */
    public function callMethods($object){
        foreach ($this->_methodCollection->getElements() as $method){
            $methodName = $method->getMethod();
            if ($methodName == '__construct'){
                continue;
            } else {
                if (method_exists()){
                    call_user_func_array(array($object, $methodName), $method->getArguments());
                }
            }
        }
        return $object;
    }
    
    /**
     * Call all static registered methods
     *
     * @return  void
     */
    public function callStaticMethods(){
        foreach ($this->_staticMethodCollection->getElements() as $method){
            $methodName = $method->getMethod();
            $className = $method->getClass();
            if (method_exists($methodName, $className)){
                call_user_func_array(array($className, $methodName), $method->getArguments());
            }            
    }
}

?>
