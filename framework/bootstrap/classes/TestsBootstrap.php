<?php

namespace spiral\framework\bootstrap;

require_once 'Bootstrap.php';
require_once 'PackageLoader.php';
require_once 'PEARLoader.php';

/**
 * Tests bootstrap
 * 
 * Launch all the tests of the framework.
 *
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class TestsBootstrap implements Bootstrap
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
		PackageLoader::addSearchDirectory('classes', 'tests');
		spl_autoload_register('\spiral\framework\bootstrap\PackageLoader::load');
		
		// Register the PEAR loader for PHPUnit framework
		spl_autoload_register('\spiral\framework\bootstrap\PEARLoader::load');
		
		// Run CLI of PHPUnit
		\PHPUnit_TextUI_Command::main();
	}
}