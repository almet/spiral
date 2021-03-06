<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\definition\exception\UnknownServiceException;

/**
 * Default implementation of Schema.
 *
 * See the interface for further information.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
	 * Create and set the active object.
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
	 * Add many services in one time
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
	 * @return  array
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
     * 
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
