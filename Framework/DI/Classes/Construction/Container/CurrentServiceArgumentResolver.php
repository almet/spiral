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
class CurrentServiceArgumentResolver extends ArgumentChainResolver
{	
	/**
	 * Return the current active service
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument		$argument
	 * @param	\Spiral\Framework\DI\Construction\Container	$container
	 * @param	Object										$currentService
	 * @return 	mixed
	 */
	protected function _resolveArgument(Schema\Argument $argument, Container $container, $currentService)
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