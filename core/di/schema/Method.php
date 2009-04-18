<?php
namespace spiral\core\di\schema;

/**
 * Interface thaht define a method for the schema 
 *
 * @author  Alexis Métaireau    16 apr. 2009
 */
interface Method{

	/**
	 * Define if an argument is a service
	 */
	const ARG_IS_SERVICE = 'ARG_IS_SERVICE';
	
    /** 
     * Set the method name of the method
     * 
     * @param   String  $name
     * @return  void
     */
    public function setName($name);
    
    /**
     * Return the method name
     * 
     * @return String
     */
    public function getName();
    
    /**
     * Add an argument to the list of arguments
     * 
     * @param   mixed   $argument
     * @return  void
     */    
    public function addArgument($argument, $asService=false);

	/**
	 * Return the complete list of arguments
	 *
	 * @param	Array
	 */
    public function getArguments();
}
