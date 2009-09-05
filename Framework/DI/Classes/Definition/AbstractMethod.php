<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction;
use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Abstract method
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
abstract class AbstractMethod
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
		
	/**
     * the construction strategy used to build the argument
     * 
     * @var 	\Spiral\Framework\DI\Definition\MethodConstructionStrategy
     */
    protected $_strategy;
    
    /**
     * return the construction strategy object
     * 
     * @return \Spiral\Framework\DI\Definition\MethodConstructionStrategy
     */
    public function getConstructionStrategy(){
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	\Spiral\Framework\DI\Construction\MethodConstructionStrategy $context
     * @return 	void
     */
    public function setConstructionStrategy(Construction\MethodConstructionStrategy $strategy){
    	$this->_strategy = $strategy;
    }  
	/**
	 * Set the method name of the method
	 *
	 * @param   String  $name
	 * @return  void
	 */
	public function setName($name)
	{
		$this->_methodName = $name;
	}

    /**
	 * Return the method name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->_methodName;
	}
	
	
    /**
	 * Return the complete list of arguments
	 *
	 * @param	array
	 */
	public function getArguments()
	{
		return $this->_arguments;
	}
    
	/**
	 * Return the argument thanks to the key (ie. arg number)
	 *
	 * @param	int
	 * @return	mixed
	 * @throws 	UnknownArgument
	 */
	public function getArgument($key)
	{
		if (!array_key_exists($key, $this->_arguments))
		{
			throw new UnknownArgumentException($key);
		}
		return $this->_arguments[$key];
	}    
    
	/**
	 * Return if the method is a static method or not
	 *
	 * @return	bool
	 */
	public function isStatic()
	{
		return $this->_isStatic;
	}

	/**
	 * Set the name of the class
	 *
	 * @param   String  $className
	 * @return  void
	 */
	public function setClassNAme($className)
	{
		$this->_isStatic = true;
		$this->_className = $className;
	}
    
	/**
	 * Returns the name of the class
	 *
	 * @return  String
	 */
	public function getClassName()
	{
		return $this->_className;
	}

    
	public function offsetExists($offset)
	{
		try{
			$this->getArgument($offset);
			return true;
		} catch (UnknownArgumentException $e)
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
