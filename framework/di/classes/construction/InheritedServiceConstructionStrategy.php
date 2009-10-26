<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\ConstructorMethod;
use \spiral\framework\di\definition\InheritedSchema;
use \spiral\framework\di\definition\Schema;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class InheritedServiceConstructionStrategy extends DefaultServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	Schema
	 * @param	Container
	 * @return 	object		Builded service, with all injected methods and arguments
	 */
	public function buildService(Schema $schema, Container $container)
	{
		$service = $this->getService();
		if ($service instanceof InheritedService)
		{
			$baseName = $service->getInheritedService();
			$base = $schema->getService($baseName);
		}
		
		if ($service->hasMethod('__construct'))
		{
			$object = $service->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		}
		elseif($base->hasMethod('__construct'))
		{
			$object = $base->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		}
		else
		{
			$className = $service->getClassName();
			if ($className === null)
			{
				$className = $base->getClassName();
			}
			
			$object = new $className;
		}
		
		$methods = array();
        foreach($base->getMethods() as $inheritedMethod)
        {
            $methods[$inheritedMethod->getName()] = $inheritedMethod;
        }
        
        foreach($service->getMethods() as $childMethod)
        {
                $methods[$childMethod->getName()] = $childMethod;
        }
		
		foreach($methods as $method)
		{
			if (! $method instanceof ConstructorMethod)
			{
				$method->getConstructionStrategy()->buildMethod($object);
			}
		}
		
		return $object;
	}
}
