<?php

/**
 * Web index
 *
 * This is the entry point of the Spiral web application.
 * Configure and run a Spiral web application.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

// Include the bootstrap class
require_once(__DIR__.'/../framework/bootstrap/classes/WebBootstrap.php');

// Bootstrap the application
$bootstrap = new \spiral\framework\bootstrap\WebBootstrap();
$bootstrap->run();
