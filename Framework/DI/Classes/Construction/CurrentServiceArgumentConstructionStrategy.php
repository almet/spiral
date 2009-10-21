<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the CurrentService argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class CurrentServiceArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * return the current service as argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	object
	 */
	public function buildArgument(Container $container, $currentService)
	{
		return $currentService;
	}
}