<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface ArgumentConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument	$argument
	 * @return	void
	 */
	public function setArgument($argument);
	
	/**
	 * Getter for argument
	 * 
	 * @return \Spiral\Framework\DI\Definition\Argument
	 */
	public function getArgument();
	
	/**
	 * return default argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	string	builded argument
	 */
	public function buildArgument(Container $container, object $currentService);
}
?>
