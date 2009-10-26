<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Schema;
use \spiral\framework\di\definition\Service;

/**
 * Interface for the Argument Construction Strategies
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface ServiceConstructionStrategy
{
	/**
	 * Setter for service
	 * 
	 * @param 	Service		$service
	 * @return	void
	 */
	public function setService(Service $service);
	
	/**
	 * Getter for service
	 * 
	 * @return Service
	 */
	public function getService();
	
	/**
	 * Default service builder strategy
	 * 
	 * @param	Schema
	 * @param	Container
	 * @return 	object		Builded service, with all injected methods and arguments
	 */
	public function buildService(Schema $schema, Container $container);
}