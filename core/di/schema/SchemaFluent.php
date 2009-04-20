<?php
namespace spiral\core\di\schema;

/**
 * Facade for the schema supporting fluent interface
 * 
 * So, you can view it as a facility to manipulate the schema classes. 
 *
 * <code>
 * $schema
 * ->registerService('test', 'spiral\tests\ToInject')
 * ->registerService('test2', 'spiral\tests\ToInject')
 *		->construct()->with('arg1', 'arg2');
 *		->call('method')->withService('service')
 *		->etc.
 * </code>
 *
 * And, when the schema is complete, you can retreive it by calling the 
 * getSchema() method.
 *
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface SchemaFluent
{

	/**
	 * By default the constructor depends on a SchemaResolver implementation, 
	 * that is useful to tell us what implementation of schema classes will be
	 * used
	 *
	 * @param	SchemaResolver	$resolver
	 * @return	void
	 */
	public function __construct(SchemaResolver $resolver);

	/**
	 * Register a service, set it as the active object
	 * 
	 * @param   string  $key
	 * @param   string  $className
	 * @return  SchemaFluent
	 */
	public function registerService($key, $className);
	
	/**
	 * Create a new method to call, add it to the schema
	 * and add it to the active methods
	 *
	 * @param   string  $methodName
	 * @return  SchemaFuent
	 */
	public function call($methodName);
	
	/**
	 * Set a static method call
	 *
	 * @param   string  $className
	 * @param   string  $methodName
	 * @return  SchemaFluent
	 */
	public function callStatic($className, $methodName);
	
	/**
	 * alias for 'call' for a constructor.
	 *
	 * @return  SchemaFluent
	 */
	public function construct();
	
	/**
	 * use all given params as param for active method objects
	 *
	 * @param   mixed
	 * @return  SchemaFluent
	 */
	public function with();
	
	/**
	 * use array $parameters as param for active method objects
	 *
	 * @param   array   $parameters
	 * @param   Bool	$asService  Specify if the given parameters has to be used as services
	 * @return  SchemaFluent
	 */
	public function setArguments($parameters, $asService);
	
	
	/**
	 * call the selected method(s) with given parameter
	 *
	 * @param   string  $parameter
	 * @return  SchemaFluent
	 */
	public function addArgument($parameter, $asService);
	
	/**
	 * same as with, for services.
	 *
	 * @param   mixed
	 * @return  SchemaFluent
	 */
	public function withServices();
	
	/**
	 * same as setArguments, for services
	 * 
	 * @param   array   $parameters
	 * @return  SchemaFluent
	 */
	public function setArgumentsAsServices($parameters);
	
	/**
	 * same as addArgument, for services
	 * 
	 * @param   string   $parameter
	 * @return  SchemaFluent
	 */
	public function addArgumentAsService($parameter);
	
	/**
	 * Return the schema object
	 *
	 * @return	Schema
	 */
	public function getSchema();
}
?>
