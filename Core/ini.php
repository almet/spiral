<?php
//namespace Spiral\Core;
/**
 * Fichier d'initialisation
 * 
 * @package 	Spiral
 * @subpackage  Core
 * @author 		Alexis Metaireau 01 Apr. 2009
 */

// Constants definitions
define('SITE_PATH', dirname(__FILE__).'/../');

// Definition of the main include path
set_include_path(SITE_PATH);

// register the autoload
require_once('Core/Loader/FileSystem.php');
spl_autoload_register(array('FileSystem', 'autoload'));
?>
