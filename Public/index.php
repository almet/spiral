<?php
/**
 * Index file, bootstrap our application
 *
 * @author  	Alexis Métaireau	28 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
 
// Require the default bootstrap class
require_once(__DIR__.'/../Framework/Bootstrap/Classes/DefaultBootstrap.php');
use \Spiral\Framework\Bootstrap\DefaultBootstrap;

// Bootstrap the application
$bootstrap = new DefaultBootstrap;
$bootstrap->run();