<?php
namespace spiral\core\di\schema;
/**
 * Default implementation of SchemaFluent interface
 *
 * See the interface for further information. 
 * 
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class SchemaFluent_Default implements SchemaFluent
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
	 * register the last method call type
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
	public function __construct(SchemaResolver $resolver = null)
	{
		if ($resolver == null)
		{
			$resolver = new SchemaResolver_Default();
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
	 * @return  Service
	 */
	protected function _getService($key, $className)
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
			$service = new $serviceClass($key, $className);
			$this->_schema->registerService($service);
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
	 */
	protected function _processArray($array, $anonymousFunction)
	{
		foreach($array as $element)
		{
			$anonymousFunction($element);
		}
	}
	
	/**
	 * Register the given method, and add it to the activeMethod list
	 * 
	 * @param	Method	$method
	 * @return	void
	 */
	protected function _registerMethod(Method $method)
	{
		if ($this->_lastCall != 'method')
		{
			$this->_activeMethods = array();
		}
		
		$this->_processArray($this->_activeServices,
			function($service) use ($method)
			{
				$service->registerMethod($method);
			});
		$this->_activeMethods[] = $method;
		$this->_lastCall = 'method';
	}
	
	/**
	 * Register a service (implement the SchemaFluent interface)
	 */
	public function registerService($key, $className)
	{
		$this->_getService($key, $className);
		return $this;
	}	

	/**
	 * Set a method to call (implement the SchemaFluent interface)
	 */	
	public function call($methodName)
	{
		$methodClass = $this->_resolver->resolveMethod();
		$method = new $methodClass($methodName);
		$this->_registerMethod($method); 
		return $this;
	}
	
	/**
	 * Set a static method to call (implements the SchemaFluent interface)
	 */
	public function callStatic($className, $methodName)
	{
		$methodClass = $this->_resolver->resolveMethod();
		$method = new $methodClass($methodName, $className);
		$this->_registerMethod($method); 
		return $this;
	}
	
	/**
	 * set a constructor method (implement the SchemaFluent interface)
	 */	
	public function construct()
	{
		$this->call('__construct');
		return $this;
	}
	
	/**
	 * Use params as parameters for active methods 
	 * (implement the SchemaFluent interface)
	 */
	public function with()
	{
		return $this->setArguments(func_get_args());
	}
	
	/**
	 * Use params as parameters for active methods 
	 * (implement the SchemaFluent interface)
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
	 * Add an argument to active methods (implement the SchemaFluent interface)
	 */	
	public function addArgument($parameter, $asService = false)
	{
		$this->_processArray($this->_activeMethods,
			function($method) use ($parameter, $asService)
			{
				$method->addArgument($parameter, $asService);
			});   
		$this->_lastCall = 'argument';
		return $this;
	}

	/**
	 * Use params like services as parameters for active methods 
	 * (implement the SchemaFluent interface)
	 */	
	public function withServices()
	{
		return $this->setArguments(func_get_args(), true);
	}
	
	/**
	 * Use params like services as parameters for active methods 
	 * (implement the SchemaFluent interface)
	 */	
	public function setArgumentsAsServices($parameters)
	{
		return $this->setArguments($parameters, true);
	}
	
	/**
	 * Add an argument as service to active methods 
	 * (implement the SchemaFluent interface)
	 */		
	public function addArgumentAsService($parameter)
	{
		return $this->addArgument($parameters, true);
	}
	
	/**
	 * Return the Schema object (implement the SchemaFluent interface)
	 */	
	public function getSchema()
	{
		return $this->_schema;
	}
}
?>
