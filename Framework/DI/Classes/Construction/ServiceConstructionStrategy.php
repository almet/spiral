<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface ServiceConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Service	$service
	 * @return	void
	 */
	public function setService($service);
	
	/**
	 * Getter for argument
	 * 
	 * @return \Spiral\Framework\DI\Definition\Service
	 */
	public function getService();
	
	/**
	 * return default argument
	 * 
	 * @return 	string	builded argument
	 */
	public function buildService();
}
?>
