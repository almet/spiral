<?php

namespace spiral\framework\di\construction;

/**
 * Resolve the CurrentService argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class CurrentServiceArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * Return the current service as argument
	 * 
	 * @param	Container	$container		
	 * @param	object		$currentService		Current active service
	 * @return 	object
	 */
	public function buildArgument(Container $container, $currentService)
	{
		return $currentService;
	}
}