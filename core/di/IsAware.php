<?php
namespace spiral\core\di;

/**
 * Interface for objects that need to have an instance of the Di Container
 *
 * @author  	Alexis Métaireau	21 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface IsAware
{
	/**
	 * Method used to store the container
	 * 
	 * @param	Container
	 */
	public function getDiContainer(container\Container $di);
}
?>
