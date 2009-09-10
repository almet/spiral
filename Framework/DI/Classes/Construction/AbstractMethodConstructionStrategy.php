<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Abstract method construction strategy
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractMethodConstructionStrategy{

	/**
	 * method
	 * 
	 * @var \Spiral\Framework\DI\Definition\Method
	 */
	protected $_method;
	
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Method	$method
	 * @return	void
	 */
	public function setMethod($method){
		$this->_method = $method;
		return $this;
	}
	
	/**
	 * Getter for method
	 * 
	 * @return \Spiral\Framework\DI\Definition\Method
	 */
	public function getMethod(){
		return $this->_method;
	}
}