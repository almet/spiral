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
class InheritedServiceConstructionStrategy  extends DefaultServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	\Spiral\Framework\DI\Definition\Schema
	 * @param	\Spiral\Framework\DI\Construction\Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Definition\Schema $schema, Construction\Container $container){
		
		$service = $this->getService();
		if ($service instanceof Definition\InheritedService){
			$baseName = $service->getInheritedService();
			$base = $schema->getService($baseName);
		}
		
		if ($service->hasMethod('__construct')){
			$object = $service->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		} elseif($base->hasMethod('__construct')){
			$object = $base->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		} else {
			$className = $service->getClassName();
			if ($className === null){
				$className = $base->getClassName();
			}
			
			$object = new $className;
		}
		
		$methods = array();
        foreach($base->getMethods() as $inheritedMethod){
            $methods[$inheritedMethod->getName()] = $inheritedMethod;
        }
        
        foreach($service->getMethods() as $childMethod){
                $methods[$childMethod->getName()] = $childMethod;
        }
		
		foreach($methods as $method){
			if (! $method instanceof Definition\ConstructorMethod){
				$method->getConstructionStrategy()->buildMethod($object);
			}
		}
		
		return $object;
	}
}
?>
