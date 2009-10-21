<?php

set_include_path(implode(PATH_SEPARATOR,
array( LIB_PATH,CLASS_PATH,APP_CLASS_PATH,get_include_path())));

use Spiral\Framework\DI\Definition;
use Spiral\Framework\DI\Construction;

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
$bootstrap->setIncludePaths();
$bootstrap->addDefaultPath('Tests');
$bootstrap->registerAutoload('Spiral\Framework\Bootstrap\PearLoader');
$bootstrap->registerAutoload();

require_once('PHPUnit/TextUI/Command.php');
PHPUnit_TextUI_Command::main();