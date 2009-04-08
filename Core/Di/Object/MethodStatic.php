<?php
namespace   Spiral\Core\Di\Object;

/**
 * MethodStatic
 * 
 * Represents a static method for an object
 * 
 * @author    Alexis Métaireau    8 Apr. 2009
 */

class MethodStatic extends Method
{    

    /** 
     * Store the name of the class
     * 
     * @var String
     */
     protected $_className = null;
     
    /**
     * construct the object and 
     * set up the name of the method, 
     * and the name of the class
     *
     * @param   String  $methodName
     * @param   String  $className
     * @return  void
     */
    public function __construct($methodName, $className){
        $this->setMethod($methodName);
        $this->setClass($className);
    }
    
    /**
     * Set the name of the class 
     * 
     * @param   String  $className
     * @return  void
     */
    public function setClass($className){
        $this->_className = $className;
    }
    
    /**
     * Returns the name of the class
     *
     * @return  String
     */
    public function getClass(){
        return $this->_className;
    }
    
    
}
?>
