<?php
namespace spiral\core\di\schema;
use exception\UnknownArgument;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class Method_Default implements Method
{
	
	/** 
	 * Store the name of the method
	 *
	 * @var String
	 */
	protected $_methodName;
	
	/**
	 * Array containing all arguments
	 * of the method
	 *
	 * @var	 Array
	 */
	protected $_arguments = array();
	
	/**
	 * Internal counter
	 * 
	 * @var	int
	 */
	protected $_count = 0;

	/**
	 * set this method as an unstatic method
	 * 
	 * @var Bool
	 */
	protected $_isStatic = false;
	
	public function __construct($methodName, $className=null)
	{
		$this->setName($methodName);
		if ($className != null)
		{
			$this->setClass($className);
		}
	}
	
	public function setName($name)
	{
		$this->_methodName = $name;
	}
	
	public function getName()
	{
		return $this->_methodName;
	}
  
	public function addArgument($argument, $asService=false)
	{
		if ($argument == Schema::ACTIVE_SERVICE){
			$asService = true;
		}
		if ($asService)
		{
			$this->_arguments[] = array($argument, Method::ARG_IS_SERVICE);
		} else 
		{
			$this->_arguments[] = array($argument, Method::ARG_IS_NOT_SERVICE);
		}
	}

	public function getArguments()
	{
		return $this->_arguments;
	}
	
	public function getArgument($key)
	{
		if (!array_key_exists($key, $this->_arguments))
		{
			throw new UnknownArgument($key);
		}
		return $this->_arguments[$key];
	}

	public function isStatic()
	{
		return $this->_isStatic;
	}

	public function setClass($className)
	{
		$this->_isStatic = true;
		$this->_className = $className;
	}

	public function getClass()
	{
		return $this->_className;
	}

	public function offsetExists($offset)
	{
		try{
			$this->getArgument($offset);
			return true;
		} catch (UnknownArgument $e)
		{
			return false;
		}
	}

	public function offsetGet($offset)
	{
		return $this->getArgument($offset);
	}
	
	public function offsetSet($offset, $value)
	{
		// not implemented
	}
	
	public function offsetUnset($offset)
	{
		// not implemented
	}
	
	public function rewind()
	{
		reset($this->_arguments);
		$this->_count = count($this->_arguments);
	}

	public function key()
	{
		return key($this->_arguments);
	}

	public function current()
	{
		return current($this->_arguments);
	}

	public function next()
	{
		next($this->_arguments);
		--$this->_count;
	}

	public function valid()
	{
		return $this->_count > 0;
	}	  
}
?>
