<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\definition\exception\UnknownMethodException;

/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * See the interface for further information.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultService extends AbstractService
{
	/**
	 * Store the name of the Service (ie. the key)
	 *
	 * @var string
	 */
	protected $_serviceName = null;
	
	/**
	 * Store the classname of the Service
	 *
	 * @var string
	 */
	protected $_className  = null;
	
	/**
	 * Internal counter
	 * 
	 * @var int
	 */
	protected $_count = 0;
	
	/**
	 * The array representing the set of methods avalaible for this Service
	 *
	 * @var array
	 */
	protected $_registredMethods = array();
    
    /**
     * Default scope, when no scope specified
     * 
     * @var string
     */
    protected $_defaultScope = 'singleton';

	/**
	 * Add a new service
	 *
	 * @param	string	$serviceName
	 * @param	string	$className
	 * @return	void
	 */
	public function __construct($service, $class, $scope=null)
	{
		$this->_serviceName = $service;
		$this->_className  = $class;
        $this->setScope($scope);
	}
    
	/**
	 * Set the method to call
	 *
	 * @param   Method  $method
	 * @param	$key
	 * @return  void
	 */
	public function addMethod(Method $method, $key = null)
	{
		if ($key == null)
		{
			$key = $method->getName();
		}
		
		$this->_registredMethods[$key] = $method;
	}
    
	/**
	 * Return the method corresponding to the name
	 *
	 * @param	string	  $name
	 * @return	Method
	 * @throws	UnknownMethodException
	 */
	public function getMethod($name)
	{
		if (!array_key_exists($name, $this->_registredMethods))
		{
			throw new UnknownMethodException($name.' in '. $this->getName());
		}
		return $this->_registredMethods[$name];
	}
	
	/**
	 * Return the internal array of methods
	 *
	 * @return array
	 */
	public function getMethods()
	{
		return $this->_registredMethods;
	}

	/**
	 * Return the classname
	 *
	 * @return	string
	 */
	public function getClassName()
	{
		return $this->_className;
	}

	/**
	 * Return the service name
	 *
	 * @return	string
	 */
	public function getName()
	{
		return $this->_serviceName;
	}

	/**
	 * Set the service name
	 *
	 * @param	string	$name
     * @return  void
	 */
	public function setName($name)
	{
		$this->_serviceName = $name;
	}

    /**
     * Check if the method exists
     * 
     * @param   string  $method
     * @return  bool
     */
    public function hasMethod($method)
    {
        return isset($this->_registredMethods[$method]);
    }
	
	public function offsetExists($offset)
	{
        return $this->hasMethod($offset);
	}

	public function offsetGet($offset)
	{
		return $this->getMethod($offset);
	}
	
	public function offsetSet($offset, $value)
	{
		return $this->addMethod($value, $offset);
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
