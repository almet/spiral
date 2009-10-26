<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Argument;

/**
 * Abstract argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractArgumentConstructionStrategy implements ArgumentConstructionStrategy
{	
	/**
	 * Argument
	 * 
	 * @var Argument
	 */
	protected $_argument;
	
	/**
	 * Setter for argument
	 * 
	 * @param 	Argument	$argument
	 * @return	void
	 */
	public function setArgument(Argument $argument)
	{
		$this->_argument = $argument;
	}
	
	/**
	 * Getter for argument
	 * 
	 * @return Argument
	 */
	public function getArgument()
	{
		return $this->_argument;
	}
}