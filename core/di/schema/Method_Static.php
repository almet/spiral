<?php
namespace spiral\core\di\schema;

/**
 * Represents a static method for an object
 * 
 * @author    Alexis Métaireau    8 Apr. 2009
 */

class Method_Static extends Method_Default
{    

    /** 
     * Store the name of the class
     * 
     * @var String
     */
     protected $_className = null;
    
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
