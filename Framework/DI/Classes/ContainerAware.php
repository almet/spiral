<?php
namespace \Spiral\Framework\DI;

/**
 * Interface for objects that need to have an instance of the Di Container
 *
 * @package     SpiralDi  
 * @author  	Alexis Métaireau	21 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface ContainerAware
{
	/**
	 * Method used to store the container
	 * 
	 * @param	SpiralDi_Container
	 */
	public function setDiContainer(SpiralDi_Container $container);
}
