<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\ArgumentConstructionStrategy;
use \spiral\framework\di\construction\Container;

/**
 * Abstract argument 
 *
 * TODO Replace spaces by tabulations in this file
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractArgument implements Argument
{
    /**
     * The construction strategy used to build the argument
     * 
     * @var ArgumentConstructionStrategy
     */
    protected $_strategy;
    
    /**
     * Return the construction strategy object
     * 
     * @return ArgumentConstructionStrategy
     */
    public function getConstructionStrategy()
    {
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	ArgumentConstructionStrategy $strategy
     * @return 	void
     */
    public function setConstructionStrategy(ArgumentConstructionStrategy $strategy)
    {
    	$strategy->setArgument($this);
		$this->_strategy = $strategy;
    }

	/**
	 * Alias Method for building argument
	 *
	 * @param	Container	$container
	 * @param	object	$currentService
	 * @return	mixed
	 */
	public function buildArgument(Container $container, $currentService)
	{
		return $this->getConstructionStrategy()->buildArgument($container, $currentService);
	}
}
