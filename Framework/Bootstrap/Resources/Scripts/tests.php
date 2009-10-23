<?php

/**
 * Test script
 *
 * Launch all the tests of the Spiral framework
 *
 * @author  	Alexis Métaireau	28 jul. 2009
 * @author  	Frédéric Sureau
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */

// Include the bootstrap class
require_once(__DIR__.'/../../Classes/TestsBootstrap.php');

// Bootstrap the application
$bootstrap = new \Spiral\Framework\Bootstrap\TestsBootstrap();
$bootstrap->run();