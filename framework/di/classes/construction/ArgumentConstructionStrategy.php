<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Argument;

/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface ArgumentConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	Argument	$argument
	 * @return	void
	 */
	public function setArgument(Argument $argument);
	
	/**
	 * Getter for argument
	 * 
	 * @return Argument
	 */
	public function getArgument();
	
	/**
	 * Return default argument
	 * 
	 * @param	Container	$container		
	 * @param	object		$currentService		Current active service
	 * @return 	string		Builded argument
	 */
	public function buildArgument(Container $container, $currentService);
}
