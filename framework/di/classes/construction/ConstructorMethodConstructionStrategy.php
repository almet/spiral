<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;

/**
 * Method Construction Strategy for constructors
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ConstructorMethodConstructionStrategy extends AbstractMethodConstructionStrategy
{
	/**
	 * Build object from its constructor
	 * 
	 * @param	Container 	Container of services
	 * @param	object		Current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, $currentService = null)
	{	
		$constructor = $this->getMethod();
		$className = $constructor->getClassName(); 
		
		// init array
		$arguments = array();
		
		foreach($constructor->getArguments() as $argument){
			$arguments[] = $argument->getConstructionStrategy()->buildArgument($container, $currentService);
		}

		$reflexionObject = new \ReflectionClass($className);
		$service = $reflexionObject->newInstanceArgs($arguments);
		
		return $service;
	}
}
