<?php

namespace spiral\framework\di\construction;

/**
 * Resolve the default argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ContainerArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * Return default argument
	 * 
	 * @param	Container	$container		
	 * @param	object		$currentService		Current active service
	 * @return 	Container
	 */
	public function buildArgument(Container $container, $currentService)
	{
		return $container;
	}
}