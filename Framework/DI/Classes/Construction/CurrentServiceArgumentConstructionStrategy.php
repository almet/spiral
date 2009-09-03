<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the CurrentService argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class CurrentServiceArgumentConstructionStrategy extends AbstractArgumentStrategy
{	
	/**
	 * return the current service as argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	string	builded argument
	 */
	public function buildArgument(Container $container, object $currentService)
	{
		if($argument instanceof Schema\CurrentServiceArgument)
		{
			return $currentService;
		}
		else
		{
			return false;
		}
	}
}