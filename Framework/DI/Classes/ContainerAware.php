<?php
namespace Spiral\Framework\DI;
use \Spiral\Framework\DI\Container\Container;

/**
 * Interface for objects that need to have an instance of the Di Container
 *
 * @author  	Alexis Métaireau	21 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface ContainerAware
{
	/**
	 * Method used to store the container
	 * 
	 * @param	\Spiral\Framework\DI\Container\Container
	 */
	public function setDiContainer(Container $container);
}
