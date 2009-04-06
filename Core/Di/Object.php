<?php
namespace Spiral\Core\Di;
/**
 * DiObject allow to store the state and the configuration of 
 * the representation of object and classes we want to inject
 *
 * @package     spiral
 * @subpackage  DI
 * @author      ametaireau 30 mars 2009
 */

class Object {

    protected $_objectName = null;
    protected $_className  = null;
    protected $_methodCollection = null;
    protected $_activeMethods = null;
    
    /**
     * Construct the object, and store the name of the object 
     * and the name of the class
     *
     * @param   string  $object name of the object
     * @param   string  $class  name of the class
     */
    public function __construct($object, $class){
        $this->_objectName = $object;
        $this->_className  = $class;
        $this->_methodCollection = new \Spiral\Core\Transfer\Collection\Base();
    }
    
    protected function _addMethod($methodName, $methodObject){
        $this->_methodCollection->setElement($methodName, $methodObject);
    }
    
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
     * @return  DiObject
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
    
    public function addArgument($arg){
        foreach($this->_activeMethods as $method){
            $method->addArgument($arg);
        }
        return $this;
    }
    
    public function getMethod($methodName){
        return $this->_methodCollection->getElement($methodName);
    }
    
    public function getClassName(){
        return $this->_className;
    }
    
    public function callMethods($object){
        foreach ($this->_methodCollection->getElements() as $method){
            $methodName = $method->getMethod();
            if ($methodName == '__construct'){
                continue;
            } else {
                call_user_func_array(array($object, $methodName), $method->getArguments());
            }
        }
        return $object;
    }
}

?>
