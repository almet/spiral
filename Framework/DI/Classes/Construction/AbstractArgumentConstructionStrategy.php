<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Abstract argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractArgumentConstructionStrategy implements ArgumentConstructionStrategy
{	
	/**
	 * Argument
	 * 
	 * @var \Spiral\Framework\DI\Definition\Argument
	 */
	protected $_argument;
	
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument	$argument
	 * @return	void
	 */
	public function setArgument($argument){
		$this->_argument = $argument;
	}
	
	/**
	 * Getter for argument
	 * 
	 * @return \Spiral\Framework\DI\Definition\Argument
	 */
	public function getArgument(){
		return $this->_argument;
	}
	
}