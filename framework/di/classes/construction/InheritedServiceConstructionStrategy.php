<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\InheritedService;
use spiral\framework\di\construction\exception\InvalidServiceException;

/**
 * Abstract Service Construction Strategy
 *
 * The Inherited service act just like a service, but contains a parent service
 * reference. At the time of building this service, we have to look at inherithed methods,
 * AND non inherithed methods.
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class InheritedServiceConstructionStrategy extends DefaultServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	\spiral\framework\di\definition\Schema
	 * @param	\spiral\framework\di\construction\Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Schema $schema, Container $container){

		// get the inherited service
		$service = $this->getService();
		if (!$service instanceof InheritedService){
			throw new InvalidServiceException(
				'"InheritedService" expected but "'.get_class($service).'" given instead'
			);
		}

		$baseName = $service->getInheritedService();
		$base = $schema->getService($baseName);

		// build the service by calling it's strategy or parent strategy.
		if ($service->hasMethod('__construct')){
			$object = $service->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		} elseif($base->hasMethod('__construct')){
			$object = $base->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		} else {
			// no __construct method has been call, build the object simply.
			// FIXME : use default service construction strategy ?
			$className = $service->getClassName();
			if ($className == null){
				$className = $base->getClassName();
			}
			
			$object = new $className;
		}

		// now, get all methods,
		$methods = array();
		foreach($base->getMethods() as $parentMethod){
			$methods[$parentMethod->getName()] = $parentMethod;
		}

		foreach($service->getMethods() as $childMethod){
				$methods[$childMethod->getName()] = $childMethod;
		}

		// and call the construction strategies
		foreach($methods as $method){
			if (! $method->getName() !== '__construct'){
				$method->getConstructionStrategy()->buildMethod($container, $object);
			}
		}

		return $object;
	}
}
?>
