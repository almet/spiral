<?php
namespace Spiral\Framework\DI\Definition;
use \Spiral\Framework\DI\Definition\Exception\UnknownMethodException;
/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * See the interface for further information.
 *
 * @author  	Alexis Métaireau	30 mar. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */

class DefaultService extends AbstractService implements Service
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
    
    /**
     * Default scope, when no scope specified
     * 
     * @var string
     */
    protected $_defaultScope = 'singleton';

	/**
	 * add a new service
	 *
	 * @param	string	$serviceName
	 * @param	string	$className
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
	 * @throws	UnknownMethod
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
	 * return the internal array of methods
	 *
	 * @return Array
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
     * check if the method exists
     * 
     * @param   string  $method
     * @return  bool>
     */
    public function hasMethod($method){
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
