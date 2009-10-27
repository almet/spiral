<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\MethodConstructionStrategy;
use \spiral\framework\di\construction\Container;

/**
 * Abstract method
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractMethod implements Method
{		
	/**
     * The construction strategy used to build the argument
     * 
     * @var MethodConstructionStrategy
     */
    protected $_strategy;
    
    /**
     * Return the construction strategy object
     * 
     * @return MethodConstructionStrategy
     */
    public function getConstructionStrategy()
    {
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	MethodConstructionStrategy	$strategy
     * @return 	void
     */
    public function setConstructionStrategy(MethodConstructionStrategy $strategy)
    {
		$strategy->setMethod($this);
    	$this->_strategy = $strategy;
    }

	/**
	 * Alias Method for building method
	 *
	 * @param	Container	$container
	 * @param	object		$currentService
	 * @return	mixed
	 */
	public function buildMethod(Container $container, $currentService=null)
	{
		return $this->getConstructionStrategy()->buildMethod($container, $currentService);
	}
}
