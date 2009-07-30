<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the ServiceReference argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class ServiceReferenceArgumentResolver extends ArgumentChainResolver
{	
	/**
	 * Return the argument (wich is a service argument), 
	 * by asking the container to build it.
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument		$argument
	 * @param	\Spiral\Framework\DI\Construction\Container	$container
	 * @param	Object										$currentService
	 * @return 	mixed
	 */
	protected function _resolveArgument(Schema\Argument $argument, Container $container, $currentService)
	{
		if($argument instanceof Schema\ServiceReferenceArgument)
		{
			return $container->getService($argument->getValue());	
		}
		else
		{
			return false;
		}
	}
}