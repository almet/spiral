<?php
namespace Spiral\Framework\Bootstrap;

require_once('Loader.php');

/**
 * Default loader interface
 *
 * Class used to load classes, regarding the default Spiral Framework Package Architecture
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class DefaultLoader{
	/**
	 * Load the required class
	 *
	 * @param	string	$class 	full classname with namespace to load
	 */
	public static function load($class)
	{
		$namespaces = split('\\\\', $class);
			
		if (array_shift($namespaces) !== "Spiral")
		{
			return false;
		} 
		
		$baseNamespace = array_shift($namespaces);
		$package = array_shift($namespaces);
		
		$className = array_pop($namespaces);
		
		$fileName = $baseNamespace.'/'.$package.'/Classes/'.implode($namespaces, '/').'/'.$className.'.php';
		
		if(file_exists($fileName) && require_once($fileName))
		{
			return true;
		} else {
			return false;
		}
	}
}