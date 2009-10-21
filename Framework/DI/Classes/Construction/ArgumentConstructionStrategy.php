<?php
namespace Spiral\Framework\DI\Construction;

use Spiral\Framework\DI\Definition;
/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface ArgumentConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument	$argument
	 * @return	void
	 */
	public function setArgument(Definition\Argument $argument);
	
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
	public function buildArgument(Container $container, $currentService);
}
?>
