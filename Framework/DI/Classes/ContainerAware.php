<?php
namespace Spiral\Framework\DI;
use \Spiral\Framework\DI\Construction\Container;

/**
 * Interface for objects that need to have an instance of the Di Container
 *
 * @author  	Alexis Métaireau	21 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface ContainerAware
{
	/**
	 * Method used to store the container
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container
	 */
	public function setDiContainer(Container $container);
}
