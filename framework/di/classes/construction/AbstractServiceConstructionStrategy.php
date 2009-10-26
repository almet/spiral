<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Service;

/**
 * Abstract service
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractServiceConstructionStrategy extends AbstractConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Service
	 * 
	 * @var Service
	 */
	protected $_service;
	
	/**
	 * Setter for service
	 * 
	 * @param 	Service	$service
	 * @return	void
	 */
	public function setService(Service $service)
	{
		$this->_service = $service;
	}
	
	/**
	 * Getter for service
	 * 
	 * @return Service
	 */
	public function getService()
	{
		return $this->_service;
	}
	
}