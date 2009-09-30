<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Resolve the default argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class ContainerArgumentConstructionStrategy extends AbstractArgumentStrategy
{	
	/**
	 * return default argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	\Spiral\Framework\DI\Construction\Container
	 */
	public function buildArgument(Container $container, $currentService)
	{
		return $container;
	}
}