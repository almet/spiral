<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface ServiceConstructionStrategy
{
	/**
	 * Setter for service
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Service	$service
	 * @return	void
	 */
	public function setService(Definition\Service $service);
	
	/**
	 * Getter for service
	 * 
	 * @return \Spiral\Framework\DI\Definition\Service
	 */
	public function getService();
	
	/**
	 * Default service builder strategy
	 * 
	 * @param	\Spiral\Framework\DI\Definition\Schema
	 * @param	\Spiral\Framework\DI\Construction\Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Definition\Schema $schema, Construction\Container $container);
}
?>
