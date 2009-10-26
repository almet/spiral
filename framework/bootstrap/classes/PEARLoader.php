<?php

namespace spiral\framework\bootstrap;

require_once 'AbstractLoader.php';

/**
 * PEAR loader
 *
 * Load classes using the PEAR naming convention.
 * Classes to load must be in the include path.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class PEARLoader extends AbstractLoader
{
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
		$namespaces = explode('_', $class);
		$fullPath = implode($namespaces, DIRECTORY_SEPARATOR).'.php';
		parent::_include($fullPath);
		
		return class_exists($class);
	}
}
