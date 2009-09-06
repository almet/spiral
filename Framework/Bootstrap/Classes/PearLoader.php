<?php
namespace Spiral\Framework\Bootstrap;

require_once('Loader.php');

/**
 * Default loader interface
 *
 * Class used to load classes, regarding the default PEAR Packages Architecture
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class PearLoader implements Loader{
	
	/**
	 * Load the required class
	 *
	 * @param	string	$class 	full classname with namespace to load
	 */
	public static function load($class)
	{
		$namespaces = explode('_', $class);
		
		$fileName = implode($namespaces, '/').'.php';

		if(file_exists($fileName) && require_once($fileName))
		{
			return true;
		} else {
			return false;
		}
	}
}
