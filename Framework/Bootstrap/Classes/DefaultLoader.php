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
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class DefaultLoader implements Loader{
	/**
	 * Default path to find files
	 * 
	 * @var string
	 */
	protected static $_defaultPath = array('Classes');

	/**
	 * Add a path to the default path
	 * 
	 * @param string $path
	 */
	public static function addDefaultPath($path){
		static::$_defaultPath[] = $path;
	}
	
	/**
	 * Load the required class
	 *
	 * @param	string	$class 	full classname with namespace to load
	 */
	public static function load($class)
	{
		$namespaces = explode('\\', $class);
		
		$spiralNamespace = array_shift($namespaces);
		if (empty($spiralNamespace))
		{
			$spiralNamespace = array_shift($namespaces);
		}
		
		if ($spiralNamespace !== "Spiral")
		{
			return false;
		} 
		
		$baseNamespace = array_shift($namespaces);
		$package = array_shift($namespaces);
		
		$className = array_pop($namespaces);

		if (is_array(static::$_defaultPath)){
			foreach(static::$_defaultPath as $path){
				$result = static::loadClass($fileName, $className, $baseNamespace, $package, $path, $namespaces);
				if ($result === true){
					return true;
				}
			}
		}
		return false;
	}

	protected static function loadClass($fileName, $className, $baseNamespace, $package, $path, $namespaces){
		$fileName = BASE_PATH.$baseNamespace.'/'.$package.'/'.$path.'/'.implode($namespaces, '/').'/'.$className.'.php';
		if(file_exists($fileName) && require_once($fileName))
		{
			return true;
		} else {
			return false;
		}
	}
}
