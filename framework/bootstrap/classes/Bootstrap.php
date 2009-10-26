<?php

namespace spiral\framework\bootstrap;

/**
 * Bootstrap
 *
 * The bootstrap is an easy to use script to launch an application.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Bootstrap 
{
	/**
	 * Bootstrap the application
	 *
	 * @return 	void
	 */
	public function run();
}
