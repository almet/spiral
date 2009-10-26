<?php
namespace Spiral\Framework\DI\Definition;
use \Spiral\Framework\DI\Definition\SchemaResolver;
use \Spiral\Framework\DI\Definition\DefaultSchemaResolver;
use \Spiral\Framework\DI\Definition\Method;

/**
 * Default implementation of SchemaFluent interface
 *
 * Facade for the schema supporting fluent interface
 * 
 * So, you can view it as a facility to manipulate the schema classes. 
 *
 * <code>
 * $fluentSchema
 * ->addService('test', 'spiral\tests\ToInject')
 * ->addService('test2', 'spiral\tests\ToInject')
 *		->construct()->with('arg1', 'arg2')
 *		->call('method')->withService('service')
 *		->etc.
 * </code>
 * 
 * 
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class FluentSchemaFacade
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
	 * @param	\Spiral\Framework\DI\Definition\SchemaResolver	$resolver
	 * @return	void
	 */
	public function __construct(SchemaResolver $resolver = null)
	{
		if ($resolver == null)
		{
			$resolver = new DefaultSchemaResolver();
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
	 * @param	string  $serviceName	name of the wanted service
	 * @param	string  $className  	classname of the service
     * @param   bool    $isSingleton
	 * @return  Service
	 */
	protected function _getService($serviceName, $className, $isSingleton = false)
	{
		if ($this->_lastCall != 'service')
		{
			$this->_activeServices = array();
		}
		
		// if the service is registred, just return the one already registred
		if (isset($this->_schema[$serviceName]))
		{
			$service = $this->_schema->getService($serviceName);
		} 
		// if service is not registred, create a new one, and add it to the active object
		else 
		{
			$serviceClass = $this->_resolver->resolveService();
			$service = new $serviceClass($serviceName, $className, $isSingleton);
			$this->_schema->addService($service);
		}
		
		// add it to the active services
		$this->_activeServices[] = $service;
		$this->_lastCall = 'service';
				
		// and return it
		return $service;
	}
	
	/**
	 * add the given method, and add it to the activeMethod list
	 * 
	 * @param	\Spiral\Framework\DI\Definition\Method	$method
	 * @return	void
	 */
	protected function _addMethod(Method $method)
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
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
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
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
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
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
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
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
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
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
	 */
	public function with()
	{
		return $this->setArguments(func_get_args());
	}
	
	/**
	 * use array $parameters as param for active method objects
	 *
	 * @param   array   $parameters
	 * @param   bool	$asService  Specify if the given parameters has to be used as services
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
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
	 * @param   string  $value
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
	 */
	public function addArgument($value, $asService = false)
	{
		if ($asService === true)
		{
			$parameter = new ServiceReferenceArgument($value);
		} 
		else
		{
			$parameter = new DefaultArgument($value);
		}
		
		foreach($this->_activeMethods as $method)
		{
			$method->addArgument($parameter);
		}
		//$service->addMethod($method);
		$this->_lastCall = 'argument';
		return $this;
	}

	/**
	 * same as with, for services.
	 *
	 * @param   mixed
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
	 */
	public function withServices()
	{
		return $this->setArguments(func_get_args(), true);
	}
	
	/**
	 * same as setArguments, for services
	 *
	 * @param   array   $parameters
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
	 */
	public function setArgumentsAsServices($parameters)
	{
		return $this->setArguments($parameters, true);
	}
	
	/**
	 * same as addArgument, for services
	 *
	 * @param   string   $parameter
	 * @return  \Spiral\Framework\DI\Definition\Builder\FluentBuilder
	 */
	public function addArgumentAsService($parameter)
	{
		return $this->addArgument($parameters, true);
	}
	
	/**
	 * Return the schema object
	 *
	 * @return	\Spiral\Framework\DI\Definition\Schema
	 */
	public function getSchema()
	{
		return $this->_schema;
	}
}
?>
