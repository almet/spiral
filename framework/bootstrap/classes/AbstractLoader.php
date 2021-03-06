<?php

namespace spiral\framework\bootstrap;

require_once 'Loader.php';

/**
 * Abstract loader
 *
 * Provide tools to load classes and file
 *
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractLoader implements Loader
{
	/**
	 * Include a file
	 * 
	 * This is quite the same as a PHP include but no warning is returned if file does not exists
	 * 
	 * @param	string	$path	Path to the file from an include path
	 * @return	void
	 */
	public static function _include($path)
	{
		$includePaths = explode(PATH_SEPARATOR, get_include_path());
		
		foreach($includePaths as $includePath)
		{
			$fullPath = $includePath.DIRECTORY_SEPARATOR.$path;
			if(file_exists($fullPath))
			{
				include($fullPath);
				return true;
			}
		}
		
		return false;
	}
}
