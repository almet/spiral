<?php

namespace spiral\framework\bootstrap;

require_once 'Bootstrap.php';
require_once 'PackageLoader.php';

/**
 * Web bootstrap
 * 
 * Launch an application from web interface.
 *
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class WebBootstrap implements Bootstrap
{
	/**
	 * Bootstrap the application
	 *
	 * @return 	void
	 */
	public function run()
	{
		// Define include path
		$spiralRootPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..';
		set_include_path( $spiralRootPath .PATH_SEPARATOR. get_include_path() );
		
		// Configure the package loader and register it in the SPL autoload queue
		PackageLoader::addSearchDirectory('classes');
		spl_autoload_register('\spiral\framework\bootstrap\PackageLoader::load');
		
		// Run the application
		// FIXME Use a MVC front request handler
		// Waiting for the MVC, you can use the public/test.php file to enjoy
		require 'public/test.php';
	}
}