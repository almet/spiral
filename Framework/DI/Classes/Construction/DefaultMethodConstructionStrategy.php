<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Default Method Construction Strategy
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class DefaultMethodConstructionStrategy implements MethodConstructionStrategy
{
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
	
	/**
	 * return builded method
	 * 
	 * @return 	string	builded method
	 */
	public function buildMethod(){
		return $this->getMethod();
	}
}
?>
