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
class CallbackMethod extends AbstractMethod implements Method
{	
	protected $_method = null;
	
    /**
	 * construct a method and set it's name
	 *
	 * @param	string	$callbackinstant
	 * @param	\Spiral\Framework\DI\Definition\Method	$method
	 */
	public function __construct($callbackInstant, Method $method)
	{
		$this->_instant = $callbackInstant;
		$this->_method = $method;
	}

	/**
	 * Return the callback method
	 * 
	 * @return \Spiral\Framework\DI\Definition\Method
	 */
	public function getMethod(){
		return $this->_method;
	}
	
	/**
	 * Return the instant of this callback
	 * 
	 * @return string
	 */
	public function getInstant(){
		return $this->_instant;
	}
	
	/**
	 * Returne the name of this method
	 * 
	 * @return string
	 */
	public function getName(){
		return 'spiralCallback'.$this->getInstant();
	}
}
?>
