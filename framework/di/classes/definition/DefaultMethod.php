<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\definition\exception\UnknownArgumentException;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultMethod extends AbstractMethod
{	
	/** 
	 * Store the name of the method
	 *
	 * @var string
	 */
	protected $_methodName;
	
	/**
	 * Array containing all arguments of the method
	 *
	 * @var	 array
	 */
	protected $_arguments = array();
	
	/**
	 * Internal counter
	 * 
	 * @var	int
	 */
	protected $_count = 0;

	/**
	 * Set this method as an unstatic method
	 * 
	 * @var bool
	 */
	protected $_isStatic = false;
	
    /**
	 * Construct a method and set its name
	 *
	 * @param	string	$methodName
	 * @param	string	$className
	 * @return	void
	 */
	public function __construct($methodName, $className=null)
	{
		$this->setName($methodName);
		if($className != null)
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
        if(! $arg instanceof Argument)
        {
            $arg = new DefaultArgument($arg);
        }
        
		$this->_arguments[] = $arg;
	}	

	/**
	 * Set the method name of the method
	 *
	 * @param   string  $name
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
	 * @param	int		Key
	 * @return	mixed
	 * @throws 	UnknownArgumentException
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
	 * @param   string  $className
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
	 * @return  string
	 */
	public function getClassName()
	{
		return $this->_className;
	}
	
}
