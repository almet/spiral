<?php
namespace Spiral\Core\Di\Object;

/**
 * Method
 * 
 * Dynamic method of an object
 * 
 * @auhtor  Alexis Métaireau    08 Apr. 2009
 */
class Method{

    /** 
     * 
     *
     */
    protected $_method;
    protected $_arguments = array();
    
    public function __construct($method){
        $this->setMethod($method);
    }
    
    public function setMethod($method){
        $this->_method = $method;
    }
    
    public function getMethod(){
        return $this->_method;
    }
    
    public function addArgument($argument){
        $this->_arguments[] = $argument;
    }
    
    public function getArguments(){
        return $this->_arguments;
    }
    
    public function buildListOfArgs(){
        // build the list of args
        $args = '';
        foreach($this->getArguments() as $arg){
            $args .= $arg.',';
        }
        
        if (!empty($args)){
            $args = substr($args, 0, -1);
        }
        
        return $args;
    }
}
?>
