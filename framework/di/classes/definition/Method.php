<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\Container;
use \spiral\framework\di\construction\MethodConstructionStrategy;

/**
 * Interface for a Schema method
 * 
 * This class represents all methods of services (classes) of the schema. 
 * It could be a standard dynamic method or a static one.
 * 
 * When defining arguments of a method representing a service, it can be 
 * resolved thanks to the ARG_IS_SERVICE const.
 *
 * Here is an exemple of how to use this interface:
 * <code>
 * // define a dynamic method, and add it a service argument, and a standard arg
 * $dMethod = new Method('methodName');
 * $dMethod->addArgument('service', true);
 * $dMethod->addArgument('arg1');
 * 
 * // define a static method, with an standard argument
 * $sMethod = new Method('staticMethod', 'className');
 * $sMethod->addArgument('arg1');
 *
 * // then, when needed, call getArgument method
 * $dMethod->getArguments()
 * // will return an associative array of arguments
 *
 * // can be used in a foreach statement:
 * foreach($dMethod as $argument)
 * {
 * 		// do some stuff with $argument
 * }
 * </code>
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Method
{		
	/**
     * Return the construction strategy object
     * 
     * @return MethodConstructionStrategy
     */
    public function getConstructionStrategy();
    
    /**
     * Set the construction strategy object
     * 
     * @param 	MethodConstructionStrategy $strategy
     * @return 	void
     */
    public function setConstructionStrategy(MethodConstructionStrategy $strategy);
    
	/**
	 * Returne the name of this method
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Alias Method for building method
	 *
	 * @param	Container	$container
	 * @param	object		$currentService
	 * @return	mixed
	 */
	public function buildMethod(Container $container, $currentService=null);
}
