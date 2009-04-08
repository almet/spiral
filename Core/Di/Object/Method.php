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
    
    /** 
     * Set the method name of the method
     * 
     * @param   String  $name
     * @return  void
     */
    public function setMethod($name){
        $this->_methodName = $name;
    }
    
    /**
     * Return the method name
     * 
     * @return String
     */
    public function getMethod(){
        return $this->_methodName;
    }
    
    /**
     * Add an argument to the list of arguments
     * 
     * @param   mixed   $argument
     * @return  void
     */    
    public function addArgument($argument){
        $this->_arguments[] = $argument;
    }
    
    /** 
     * Return the list of arguments
     * 
     * return   array
     */
    public function getArguments(){
        return $this->_arguments;
    }
    
    /**
     * Build a list of comma separated arguments
     * from an array list of args.
     *
     * FIXME: Store in another place ?
     *
     * @return  String
     */
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
