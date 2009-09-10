<?php
namespace Spiral\Framework\Bootstrap;

/**
 * Loader interface
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Loader{
	/**
	 * Load the required class
	 *
	 * @param	string	$class 	full classname with namespace to load
	 */
	public static function load($class);
}
