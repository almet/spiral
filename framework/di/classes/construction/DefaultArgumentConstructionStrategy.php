<?php

namespace spiral\framework\di\construction;

/**
 * Resolve the ActiveService argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{	
	/**
	 * Return container as argument
	 * 
	 * @param	Container	$container		
	 * @param	object		$currentService		Current active service
	 * @return 	string		Builded argument
	 */
	public function buildArgument(Container $container, $currentService)
	{
		$argument = $this->getArgument();
		
		return $argument->getValue();
	}
}