<?php
/**
 * Default implementation of SchemaFluent interface
 *
 * See the interface for further information. 
 * 
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class SpiralDi_Schema_SchemaFluent_Default implements SpiralDi_Schema_SchemaFluent
{
	/**
	 * Array of active services
	 *
	 * @var Array
	 */
	protected $_activeServices = array();
	
	/**
	 * Array of active method
	 * 
	 * @var array
	 */
	protected $_activeMethods = array();
	
	/**
	 * Resolver for the schema classes
	 *
	 * @var	SchemaResolver
	 */
	protected $_resolver = null;
	
	/**
	 * The schema object
	 *
	 * @var	Schema
	 */
	protected $_schema = null;
	
	/**
	 * add the last method call type
	 *
	 * @var	string
	 */
	protected $_lastCall = 'service';
	
	/**
	 * By default, if no resolver is set, the resolver is set to the default 
	 * SchemaResolver implementation
	 *
	 * @param	SchemaResolver	$resolver
	 * @return	void
	 */
	public function __construct(SpiralDi_Schema_SchemaResolver $resolver = null)
	{
		if ($resolver == null)
		{
			$resolver = new SpiralDi_Schema_SchemaResolver_Default();
		}
		
		$this->_resolver = $resolver;
		
		// create the schema object and store it
		$schemaClass = $this->_resolver->resolveSchema();
		$this->_schema = new $schemaClass();
	}
	
	/**
	 * Return all active services for now, in an array, or null if no active 
	 * service is registred
	 *
	 * @return  array|null
	 */
	protected function _getActiveServices()
	{
		// if we have a single object to return, build an array with it
		if (!is_array($this->_activeServices) && !empty($this->_activeServices))
		{
			$services = array($this->_activeServices);
		
		// otherwise, just return the array ..
		} elseif(is_array($this->_activeServices)){
			$services = $this->_activeServices;
		
		// or nothin'
		} else 
		{
			$services = null;
		}
		
		return $services;
	}
	
	/**
	 * Check out if a service with the given name is already registred and 
	 * return it when possible.
	 *
	 * If not, create a new one, store it and return it
	 *
	 * @param	string  $key		name of the wanted service
	 * @param	string  $className  classname of the service
     * @param   bool    $isSingleton
	 * @return  Service
	 */
	protected function _getService($key, $className, $isSingleton = false)
	{
		if ($this->_lastCall != 'service')
		{
			$this->_activeServices = array();
		}
		
		// if the service is registred, just return the one already registred
		if (array_key_exists($key, $this->_schema))
		{
			$service = $this->_schema->getService($key);
			
		// of not, create a new one, and add it to the active object
		} else 
		{
			$serviceClass = $this->_resolver->resolveService();
			$service = new $serviceClass($key, $className, $isSingleton);
			$this->_schema->addService($service);
		}
		// add it to the active services
		$this->_activeServices[] = $service;
		$this->_lastCall = 'service';
				
		// and return it
		return $service;
	}
	
	/**
	 * Loop on the array of active services and process it
	 * with an anonymous function
	 *
	 * @param   Closure	 $anonymousFunction
	 * @return  void
	 *
	protected function _processArray($array, $anonymousFunction)
	{
		foreach($array as $element)
		{
			$anonymousFunction($element);
		}
	}*/
	
	/**
	 * add the given method, and add it to the activeMethod list
	 * 
	 * @param	Method	$method
	 * @return	void
	 */
	protected function _addMethod(SpiralDi_Schema_Method $method)
	{
		if ($this->_lastCall != 'method')
		{
			$this->_activeMethods = array();
		}

		foreach($this->_activeServices as $service)
		{
			$service->addMethod($method);
		}
		
		$this->_activeMethods[] = $method;
		$this->_lastCall = 'method';
	}
	
	/**
	 * add a service, set it as the active object
	 *
	 * @param   string  $key
	 * @param   string  $className
     * @param   bool    $isSingleton
	 * @return  SchemaFluent
	 */
	public function addService($key, $className, $isSingleton=true)
	{
		$this->_getService($key, $className, $isSingleton);
		return $this;
	}	

	/**
	 * Create a new method to call, add it to the schema
	 * and add it to the active methods
	 *
	 * @param   string  $methodName
	 * @return  SchemaFuent
	 */
	public function call($methodName)
	{
		$methodClass = $this->_resolver->resolveMethod();
		$method = new $methodClass($methodName);
		$this->_addMethod($method); 
		return $this;
	}
	
	/**
	 * Set a static method call
	 *
	 * @param   string  $className
	 * @param   string  $methodName
	 * @return  SchemaFluent
	 */
	public function callStatic($className, $methodName)
	{
		$methodClass = $this->_resolver->resolveMethod();
		$method = new $methodClass($methodName, $className);
		$this->_addMethod($method); 
		return $this;
	}
	
	/**
	 * alias for 'call' for a constructor.
	 *
	 * @return  SchemaFluent
	 */
	public function construct()
	{
		$this->call('__construct');
		return $this;
	}
	
	/**
	 * use all given params as param for active method objects
	 *
	 * @param   mixed
	 * @return  SchemaFluent
	 */
	public function with()
	{
		return $this->setArguments(func_get_args());
	}
	
	/**
	 * use array $parameters as param for active method objects
	 *
	 * @param   array   $parameters
	 * @param   Bool	$asService  Specify if the given parameters has to be used as services
	 * @return  SchemaFluent
	 */
	public function setArguments($parameters, $asService = false)
	{
		foreach($parameters as $parameter)
		{
			$this->addArgument($parameter, $asService);
		}
		return $this;
	}
	
	/**
	 * call the selected method(s) with given parameter
	 *
	 * @param   string  $parameter
	 * @return  SchemaFluent
	 */
	public function addArgument($parameter, $asService = false)
	{
		foreach($this->_activeMethods as $method)
		{
			$method->addArgument($parameter, $asService);
		}
		//$service->addMethod($method);
		$this->_lastCall = 'argument';
		return $this;
	}

	/**
	 * same as with, for services.
	 *
	 * @param   mixed
	 * @return  SchemaFluent
	 */
	public function withServices()
	{
		return $this->setArguments(func_get_args(), true);
	}
	
	/**
	 * same as setArguments, for services
	 *
	 * @param   array   $parameters
	 * @return  SchemaFluent
	 */
	public function setArgumentsAsServices($parameters)
	{
		return $this->setArguments($parameters, true);
	}
	
	/**
	 * same as addArgument, for services
	 *
	 * @param   string   $parameter
	 * @return  SchemaFluent
	 */
	public function addArgumentAsService($parameter)
	{
		return $this->addArgument($parameters, true);
	}
	
	/**
	 * Return the schema object
	 *
	 * @return	Schema
	 */
	public function getSchema()
	{
		return $this->_schema;
	}
}
?>
