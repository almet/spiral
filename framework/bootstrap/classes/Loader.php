<?php

namespace spiral\framework\bootstrap;

/**
 * Loader interface
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Loader
{
	/**
	 * Try to load the required class
	 * 
	 * If the class cannot be loaded, this method return FALSE, else return TRUE.
	 *
	 * @param	string	$class 	Full classname with namespace to load
	 * @return	boolean
	 */
	public static function load($class);
}
