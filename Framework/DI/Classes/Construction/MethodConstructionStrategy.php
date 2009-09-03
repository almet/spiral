<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Interface for the Method Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface MethodConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Method	$method
	 * @return	void
	 */
	public function setMethod($method);
	
	/**
	 * Getter for method
	 * 
	 * @return \Spiral\Framework\DI\Definition\Method
	 */
	public function getMethod();
	
	/**
	 * return builded method
	 * 
	 * @return 	string	builded method
	 */
	public function buildMethod();
}
?>
