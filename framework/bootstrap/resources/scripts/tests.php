<?php

/**
 * Test script
 *
 * Launch all the tests of the Spiral framework
 *
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

// Include the bootstrap class
require_once __DIR__.str_replace('/', DIRECTORY_SEPARATOR, '/../../classes/TestsBootstrap.php');

// Bootstrap the application
$bootstrap = new \spiral\framework\bootstrap\TestsBootstrap();
$bootstrap->run();