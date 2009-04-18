<?php
namespace spiral\core\di;

/**
 * Facade for the schema that support fluent interface
 *
 * @package     Spiral/Core/Di
 * @auhtor      Alexis Métaireau 16 apr. 2009
 */
interface SchemaFluent{
    /**
     * create and set the active object.
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  SchemaFluent
     */
    public function registerService($key, $className);
    
    /**
     * Set the method to call.
     *
     * @param   string  $methodName
     * @return  SchemaFuent
     */
    public function call($methodName);
    
    
    /**
     * Set a static method to call
     *
     * @param   string  $className
     * @param   string  $methodName
     * @return  SchemaFluent
     */
    public function staticCall($className, $methodName);
    
    /**
     * alias for 'call' for a constructor.
     *
     * @return  SchemaFluent
     */
    public function construct();
    
    /**
     * inject all given params to active objects
     *
     * @param   mixed
     * @return  SchemaFluent
     */
    public function injectWith();
    
    /**
     * call all the given parameters to the active Objects
     *
     * @param   array   $parameters
     * @param   Bool    $asService  Specify if the given parameters has to be used as services
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
     * inject all given params to active objects 
     *
     * @param   mixed
     * @return  SchemaFluent
     */
    public function injectWithServices();
    
    /**
     * Alias for setArgument, for services
     * 
     * @param   array   $parameters
     * @return  SchemaFluent
     */
    public function setArgumentsAsServices($parameters);
    
    /**
     * Alias for addArgument, for a service
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
