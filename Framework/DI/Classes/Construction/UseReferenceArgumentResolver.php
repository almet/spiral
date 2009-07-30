<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the UseReference argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class CurrentServiceArgumentResolver extends ArgumentChainResolver
{	
	/**
	 * Use a factory to resolve the given argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument		$argument
	 * @param	\Spiral\Framework\DI\Construction\Container	$container
	 * @param	Object										$currentService
	 * @return 	Object
	 */
	abstract protected function _resolveArgument(Schema\Argument $argument, Container $container, $currentService)
	{
		if ($argument instanceof Schema\UseReferenceArgument)
		{
			$service = $container->getService($argument->getReference());
			$factoryMethod = $argument->getFactoryMethod();
			$attribute = $argument->getValue();
	
			if(!empty($factoryMethod))
			{
				return $service->$factoryMethod($attribute);
			}
			else
			{
				return $service->$attribute;
			}
		}
		else
		{
			return false;
		}
	}
}