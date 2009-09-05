<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Resolve the UseReference argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class UseReferenceArgumentConstructionStrategy extends AbstractArgumentStrategy
{	
	/**
	 * Use a service as a factory to return an argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	string	builded argument
	 */
	public function buildArgument(Container $container, object $currentService){
		if ($argument instanceof Schema\UseReferenceArgument)
		{
			$service = $container->getService($argument->getReference());
			$factoryMethod = $argument->getFactoryMethod();
			$attribute = $this->getArgument()->getValue();
	
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