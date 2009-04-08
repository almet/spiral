<?php
namespace   Spiral\Core\Di\Object;

/**
 * StaticMethod
 * 
 * A static method for an object
 * 
 * @author    Alexis Métaireau    date
 */

class StaticMethod extends Method
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
        $this>setClass($className);
    }
    
    /**
     * Set the name of the class 
     * 
     * @param   String  $className
     * @return  void
     */
    public function setClass($className){
        $this->_className = $className:
    }
    
    
}
?>
