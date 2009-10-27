<?php

namespace spiral\framework\di\definition;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class CallbackMethod extends AbstractMethod
{
	/**
	 * Method
	 * 
	 * @var	Method
	 */
	protected $_method = null;
	
    /**
	 * Construct a method and set it's name
	 *
	 * @param	string		$callbackInstant
	 * @param	Method		$method
	 */
	public function __construct($callbackInstant, Method $method)
	{
		$this->_instant = $callbackInstant;
		$this->_method = $method;
	}

	/**
	 * Return the callback method
	 * 
	 * @return Method
	 */
	public function getMethod()
	{
		return $this->_method;
	}
	
	/**
	 * Return the instant of this callback
	 * 
	 * @return string
	 */
	public function getInstant()
	{
		return $this->_instant;
	}
	
	/**
	 * Returne the name of this method
	 * 
	 * @return string
	 */
	public function getName()
	{
		return 'spiralCallback'.$this->getInstant();
	}
}
