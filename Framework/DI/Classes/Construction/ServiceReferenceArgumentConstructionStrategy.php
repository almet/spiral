<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the ServiceReference argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class ServiceReferenceArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * return a service as argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	string	builded argument
	 */
	public function buildArgument(Container $container, object $currentService)
	{
		if($argument instanceof Schema\ServiceReferenceArgument)
		{
			return $container->getService($this->getArgument()->getValue());	
		}
		else
		{
			return false;
		}
	}
}