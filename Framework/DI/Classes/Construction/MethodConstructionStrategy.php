<?php
namespace Spiral\Framework\DI\Construction;

use \spiral\Framework\DI\Definition;

/**
 * Interface for the Method Construction Strategies
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
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
	 * call the method and return the result
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container container of services
	 * @param	object	current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, object $currentService = null);
}
?>
