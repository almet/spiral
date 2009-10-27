<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\ArgumentConstructionStrategy;
use \spiral\framework\di\construction\Container;

/**
 * Interface for a Argument class
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Argument
{
    /**
     * Return the argument value
     *
     * @return  mixed
     */
    public function getValue();
    
	/**
     * Return the construction strategy object
     * 
     * @return ArgumentConstructionStrategy
     */
    public function getConstructionStrategy();
    
    /**
     * Set the construction strategy object
     * 
     * @param 	ArgumentConstructionStrategy	$strategy
     * @return 	void
     */
    public function setConstructionStrategy(ArgumentConstructionStrategy $strategy);

	/**
	 * Alias Method for building argument
	 *
	 * @param	Container	$container
	 * @param	object		$currentService
	 * @return	mixed
	 */
	public function buildArgument(Container $container, $currentService);
}
