<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Definition\Service;
use \Spiral\Framework\DI\Definition\Exception\UnknownServiceException;

/**
 * Default implementation of Schema.
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class DefaultSchema implements Schema
{
	/**
	 * Array containing all registred services
	 * 
	 * @var array
	 */
	protected $_registredServices = array();
	protected $_count = 0;
    
	/**
	 * create and set the active object.
	 *
	 * @param	Service	$service
	 * @param   string  $key
	 * @return  void
	 */
	public function addService(Service $service, $key = null)
	{
		if ($key == null)
		{
			$key = $service->getName();
		}
		
		$this->_registredServices[$key] = $service;
	}

	/**
	 * add many services in one time
	 *
	 * Each element of array must be an instance of Service.
	 *
	 * @param	array	$services
	 * @return  void
	 */
	public function addServices(array $services)
	{
		foreach($services as $service)
		{
			$this->addService($service);
		}
	}

	/**
	 * Return a registred service
	 *
	 * @param	string	$key
	 * @return	mixed
	 */
	public function getService($key)
	{
		if (!$this->hasService($key))
		{
			throw new UnknownServiceException($key);
		}
		
		return $this->_registredServices[$key];
	}

	/**
	 * Return an array of all registred services
	 *
	 * @return  Array
	 */
	public function getServices()
	{
		return $this->_registredServices;
	}

    /**
     * Check if the service is defined in the schema
     * 
     * @param   string  $key
     * @return  bool
     */
	public function hasService($key)
	{
		return array_key_exists($key, $this->_registredServices);
	}

    /**
     * Implemented for the ArrayAccess Interface
     * @param   string  $key
     */
	public function unsetService($key)
	{
		// not implemented
	}

    /**
     * Alias of hasService
     * 
     * @param   string  $offset
     * @return  bool
     */
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
		return $this->addService($value, $offset);
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
