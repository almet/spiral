<?php

namespace spiral\framework\bootstrap;

require_once 'AbstractLoader.php';

/**
 * Package loader
 *
 * Load code from Spiral packages.
 * The root directory of Spiral must be set as an include path.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class PackageLoader extends AbstractLoader
{
	/**
	 * Directories to check
	 * 
	 * List of the directories of the package to search in when looking for a class.
	 * 
	 * @var	array
	 */
	protected static $_searchDirectories = array('Classes');

	/**
	 * Add one or more search directory to the list
	 * 
	 * @param	...		$searchDirectories
	 * @return	void
	 */
	public static function addSearchDirectory()
	{
		$searchDirectories = func_get_args();
		$newDirectories = array_diff($searchDirectories, static::$_searchDirectories);
		static::$_searchDirectories = array_merge(static::$_searchDirectories, $newDirectories);
	}

	/**
	 * Try to load the required class
	 * 
	 * If the class cannot be loaded, this method return FALSE, else return TRUE.
	 *
	 * @param	string	$class 	Full classname with namespace to load
	 * @return	boolean
	 */
	public static function load($class)
	{
		$namespaces = explode('\\', $class);
		
		$mainNamespace = array_shift($namespaces);
		if(empty($mainNamespace))
		{
			$mainNamespace = array_shift($namespaces);
		}
		
		if($mainNamespace !== 'Spiral')
		{
			return false;
		}
		
		$applicationNamespace = array_shift($namespaces);
		$package = array_shift($namespaces);
		$className = array_pop($namespaces);

		foreach(static::$_searchDirectories as $packageDirectory)
		{
			static::_loadClass($className, $applicationNamespace, $package, $packageDirectory, $namespaces);
			if(class_exists($class) === true)
			{
				return true;
			}
		}
		
		return false;
	}

	/**
	 * Try to load a class
	 * 
	 * @param	string	$className
	 * @param	string	$applicationNamespace
	 * @param	string	$package
	 * @param	string	$packageDirectory
	 * @param	string	$packageNamespaces
	 * @return	boolean
	 */
	protected static function _loadClass($className, $applicationNamespace, $package, $packageDirectory, $packageNamespaces)
	{
		$fullPath = $applicationNamespace.DIRECTORY_SEPARATOR
					.$package.DIRECTORY_SEPARATOR
					.$packageDirectory.DIRECTORY_SEPARATOR
					.implode($packageNamespaces, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR
					.$className.'.php';

		parent::_include($fullPath);
	}
}
