<?php
namespace Spiral\Framework\DI\Construction;
use Spiral\Framework\DI\Definition;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class DefaultServiceConstructionStrategy  extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Construction\Container $container){
		
		$service = $this->getService();
		$object = $service->getConstructor()->getConstructionStrategy()->buildMethod();
		
		foreach($service->getMethods() as $method){
			if (! $method instanceof Definition\ConstructorMethod){
				$method->getConstructionStrategy()->buildMethod($object);
			}
		}
		
		return $object;
	}
}
?>
