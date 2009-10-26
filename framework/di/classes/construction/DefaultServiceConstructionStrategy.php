<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Schema;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultServiceConstructionStrategy  extends AbstractServiceConstructionStrategy
{
	/**
	 * Default service builder strategy
	 * 
	 * @param	Schema
	 * @param	Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Schema $schema, Container $container)
	{
		$service = $this->getService();
		
		if($service->hasMethod('__construct'))
		{
			$object = $service->getMethod('__construct')->getConstructionStrategy()->buildMethod();
		}
		else
		{
			$className =$service->getClassName();
			$object = new $className;
		}
		
		foreach($service->getMethods() as $method)
		{
			if(! $method instanceof Definition\ConstructorMethod)
			{
				$method->getConstructionStrategy()->buildMethod($container, $object);
			}
		}
		
		return $object;
	}
}
