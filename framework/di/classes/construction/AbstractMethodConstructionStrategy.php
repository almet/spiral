<?php

namespace spiral\framework\di\construction;

use spiral\framework\di\definition\Method;
use spiral\framework\di\construction\exception\MethodNotSetException;

/**
 * Abstract method construction strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractMethodConstructionStrategy implements MethodConstructionStrategy
{

	/**
	 * Method
	 * 
	 * @var Method
	 */
	protected $_method;
	
	/**
	 * Setter for argument
	 * 
	 * @param 	Method	$method
	 * @return	void
	 */
	public function setMethod(Method $method)
	{
		$this->_method = $method;
		return $this;
	}
	
	/**
	 * Getter for method
	 * 
	 * @return Method
	 */
	public function getMethod()
	{
		if ($this->_method === null)
		{
			throw new MethodNotSetException();
		}
		return $this->_method;
	}
}