<?php
namespace Spiral\Framework\Bootstrap;

/**
 * Loader interface
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Loader{
	/**
	 * Load the required class
	 *
	 * @param	string	$class 	full classname with namespace to load
	 */
	public function load($class);
}
