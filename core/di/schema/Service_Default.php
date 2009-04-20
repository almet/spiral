<?php
namespace spiral\core\di\schema;
use \spiral\core\di\schema\exception\UnknownMethod as UnknownMethod;

/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * See the interface for further information.
 *
 * @author  	Alexis Métaireau	30 mar. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */

class Service_Default implements Service
{

	/**
	 * Store the name of the Service (ie. the key)
	 *
	 * @var String
	 */
	protected $_serviceName = null;
	
	/**
	 * Store the classname of the Service
	 *
	 * @var String
	 */
	protected $_className  = null;
	
	/**
	 * internal counter
	 * 
	 * @var 	int
	 */
	protected $_count = 0;
	
	/**
	 * the array representing the set of methods avalaible for this Service
	 *
	 * @var Array
	 */
	protected $_registredMethods = array();
 
	public function __construct($service, $class)
	{
		$this->_serviceName = $service;
		$this->_className  = $class;
	}

	public function registerMethod(Method $method, $key = null)
	{
		if ($key == null)
		{
			$key = $method->getName();
		}
		
		$this->_registredMethods[$key] = $method;
	}

	public function getMethod($name)
	{
		if (!array_key_exists($name, $this->_registredMethods))
		{
			throw new UnknownMethod($name);
		}
		return $this->_registredMethods[$name];
	}

	public function getRegistredMethods()
	{
		return $this->_registredMethods;
	}
	
	public function getClassName()
	{
		return $this->_className;
	}

	public function getName()
	{
		return $this->_serviceName;
	}

	public function setName($name)
	{
		$this->_serviceName = $name;
	}
	
	public function offsetExists($offset)
	{
		try
		{
			$this->getMethod($offset);
			return true;
		} catch(UnknownMethod $e)
		{
			return false;
		}
	}

	public function offsetGet($offset)
	{
		return $this->getMethod($offset);
	}
	
	public function offsetSet($offset, $value)
	{
		return $this->registerMethod($value, $offset);
	}
	
	public function offsetUnset($offset)
	{
		// not implemented
	}
	
	public function rewind()
	{
		reset($this->_registredMethods);
		$this->_count = count($this->_registredMethods);
	}

	public function key()
	{
		return key($this->_registredMethods);
	}

	public function current()
	{
		return current($this->_registredMethods);
	}

	public function next()
	{
		next($this->_registredMethods);
		--$this->_count;
	}

	public function valid()
	{
		return $this->_count > 0;
	}	
}

?>
