<?php

namespace Spiral\Framework\Bootstrap;

require_once('AbstractLoader.php');

/**
 * PEAR loader
 *
 * Load classes using the PEAR naming convention.
 * Classes to load must be in the include path.
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class PEARLoader extends AbstractLoader
{
	/**
	 * Try to load the required class
	 * 
	 * If the class cannot be loaded, this method return FALSE, else return TRUE.
	 *
	 * @param	string	$class 	Full classname with namespace to load
	 * 
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
