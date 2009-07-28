<?php
namespace Spiral\Framework\DI\Schema;

/**
 * Interface for a Schema method
 * 
 * This class represents all methods of services (classes) of the schema. 
 * It could be a standard dynamic method or a static one.
 * 
 * When defining arguments of a method representing a service, it can be 
 * resolved thanks to the ARG_IS_SERVICE const.
 *
 * Here is an exemple of how to use this interface:
 * <code>
 * // define a dynamic method, and add it a service argument, and a standard arg
 * $dMethod = new Method('methodName');
 * $dMethod->addArgument('service', true);
 * $dMethod->addArgument('arg1');
 * 
 * // define a static method, with an standard argument
 * $sMethod = new Method('staticMethod', 'className');
 * $sMethod->addArgument('arg1');
 *
 * // then, when needed, call getArgument method
 * $dMethod->getArguments()
 * // will return an associative array of arguments
 *
 * // can be used in a foreach statement:
 * foreach($dMethod as $argument){
 * 		// do some stuff with $argument
 * }
 * </code>
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Method extends Iterator, ArrayAccess
{
	/**
	 * construct a method and set it's name
	 * 
	 * @param	string	$methodName
	 * @param	string	$className
	 */
	public function __construct($methodName, $className=null);
	
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
	 * @return string
	 */
	public function getName();
	
	/**
	 * Add an argument to the list of arguments
	 * 
	 * @param   mixed   $argument
	 * @return  void
	 */	
	public function addArgument($argument);

	/**
	 * Return the complete list of arguments
	 *
	 * @param	array
	 */
	public function getArguments();

	/**
	 * Return the argument thanks to the key (ie. arg number)
	 *
	 * @param	int
	 * @return	mixed
	 * @throws 	UnknownArgument
	 */
	public function getArgument($key);

	/**
	 * Return if the method is a static method or not
	 *
	 * @return	bool
	 */
	public function isStatic();
    
	/**
	 * Set the name of the class
	 *
	 * @param   String  $className
	 * @return  void
	 */
	public function setClass($className);

	/**
	 * Returns the name of the class
	 *
	 * @return  String
	 */
	public function getClass();

}
