<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction;

/**
 * Interface for a Argument class
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
interface Argument {

    /**
     * return the argument value
     *
     * @return  mixed
     */
    public function getValue();
    
	/**
     * return the construction strategy object
     * 
     * @return \Spiral\Framework\DI\Definition\ArgumentConstructionStrategy
     */
    public function getConstructionStrategy();
    
    /**
     * Set the construction strategy object
     * 
     * @param 	ArgumentConstructionContext $context
     * @return 	void
     */
    public function setConstructionStrategy(Construction\ArgumentConstructionStrategy $strategy);


	/**
	 * Alias Method for building argument
	 *
	 * @param Container $container
	 * @param object $currentService
	 * @return mixed
	 */
	public function buildArgument(Construction\Container $container, $currentService);
}
?>
