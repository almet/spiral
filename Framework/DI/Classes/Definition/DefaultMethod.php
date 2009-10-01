<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class DefaultMethod extends AbstractMethod implements Method
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
	 * construct a method and set it's name
	 *
	 * @param	string	$methodName
	 * @param	string	$className
	 */
	public function __construct($methodName, $className=null)
	{
		$this->setName($methodName);
		if ($className != null)
		{
			$this->setClassName($className);
		}
	}

    /**
	 * Add an argument to the list of arguments
	 *
	 * @param   mixed   $argument
	 * @return  void
	 */	
	public function addArgument($arg)
	{
        if (! $arg instanceof Argument){
            $arg = new DefaultArgument($arg);
        }
        
		$this->_arguments[] = $arg;
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
	public function setClassName($className)
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
	
}
?>
