<?php

/**
 * The Service class allow to store the state and the configuration of
 * the representation of Service and classes we want to call
 *
 * See the interface for further information.
 *
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	30 mar. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */

class SpiralDi_Schema_Service_Default implements SpiralDi_Schema_Service
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
     * Store if the service is a singleton or not
     *
     * @var Bool
     */
    protected $_isSingleton;
	
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
     * The eventual factory method to call for using the service as a factory
     *
     * @var string
     */
    protected $_factoryMethod = null;

	/**
	 * add a new service
	 *
	 * @param	string	$serviceName
	 * @param	string	$className
	 */
	public function __construct($service, $class, $isSingleton=true)
	{
		$this->_serviceName = $service;
		$this->_className  = $class;
        $this->_isSingleton = $isSingleton;
	}
    
	/**
	 * Set the method to call
	 *
	 * @param   Method  $method
	 * @param	$key
	 * @return  void
	 */
	public function addMethod(SpiralDi_Schema_Method $method, $key = null)
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
			throw new SpiralDi_Schema_Exception_UnknownMethod($name.' in '. $this->getName());
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
     * Tell if this service is a singleton or not
     *
     * @return  void
     */
    public function isSingleton()
    {
        return $this->_isSingleton;
    }

    /**
     * Set the factory method to use when calling this service
     *
     * @param   string  $factoryMethod
     */
    public function setFactoryMethod($factoryMethod){
        $this->_factoryMethod = $factoryMethod;
    }

    /**
     * Retreive the factory method used to eventually use the service as a
     * factory
     *
     * @return  string
     */
    public function getFactoryMethod(){
        return $this->_factoryMethod;
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

?>
