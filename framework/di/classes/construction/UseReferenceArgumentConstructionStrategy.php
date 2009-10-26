<?php

namespace spiral\framework\di\construction;

/**
 * Resolve the UseReference argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class UseReferenceArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * Use a service as a factory to return an argument
	 * 
	 * @param	Container	$container		
	 * @param	object		$currentService		Current active service
	 * @return 	string		Builded argument
	 */
	public function buildArgument(Container $container, $currentService)
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
}