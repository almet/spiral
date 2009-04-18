<?php
namespace spiral\core\di\schema;

/**
 * Default implementation of a method
 * 
 * @auhtor  Alexis Métaireau    08 Apr. 2009
 */
class Method_Default implements Method{

    /** 
     * Store the name of the method
     *
     * @var String
     */
    protected $_methodName;
    
    /**
     * Array containing all arguments
     * of the method
     *
     * @var     Array
     */
    protected $_arguments = array();
    
    /**
     * construct the object and 
     * set up the method name of the method
     *
     * @return  void
     */
    public function __construct($methodName){
        $this->setMethod($methodName);
    }
    
    public function setName($name){
        $this->_methodName = $name;
    }
    
    public function getName(){
        return $this->_methodName;
    }
  
    public function addArgument($argument, $asService=false){
        if ($asService){
            $this->_arguments[] = array(self::ARG_IS_SERVICE, $argument);
        } else {
            $this->_arguments[] = array($argument, null);
        }
    }

    public function getArguments(){
        return $this->_arguments;
    }
}
?>
