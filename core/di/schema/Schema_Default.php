<?php
namespace spiral\core\di\schema;

/**
 * Default implementation of Schema.
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class Schema_Default implements Schema
{

	/**
	 * Array containing all registred services
	 * 
	 * @var array
	 */
	protected $_registredServices = array();
	
	
	protected $_count = 0;
	
	public function registerService(Service $service, $key = null)
	{
		if ($key == null)
		{
			$key = $service->getName();
		}
		
		$this->_registredServices[$key] = $service;
	}

	public function getService($key)
	{
		if (!$this->hasService($key))
		{
			throw new exception\UnknownService($key);
		}
		
		return $this->_registredServices[$key];
	}

	public function getRegistredServices()
	{
		return $this->_registredServices;
	}

	public function hasService($key)
	{
		return array_key_exists($key, $this->_registredServices);
	}

	public function unsetService($key)
	{
		// not implemented
	}

	public function offsetExists($offset)
	{
		return $this->hasService($offset);
	}

	public function offsetGet($offset)
	{
		return $this->getService($offset);
	}
	
	public function offsetSet($offset, $value)
	{
		return $this->registerService($value, $offset);
	}
	
	public function offsetUnset($offset)
	{
		$this->unsetService($offset);
	}
	
	public function rewind()
	{
		reset($this->_registredServices);
		$this->_count = count($this->_registredServices);
	}

	public function key()
	{
		return key($this->_registredServices);
	}

	public function current()
	{
		return current($this->_registredServices);
	}

	public function next()
	{
		next($this->_registredServices);
		--$this->_count;
	}

	public function valid()
	{
		return $this->_count > 0;
	}
}
?>
