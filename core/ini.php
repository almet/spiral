<?php
/**
 * Fichier d'initialisation
 * 
 * @author 		Alexis Metaireau 	01 Apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */

// Constants definitions
define('SITE_PATH', dirname(__FILE__).'/../');

// Definition of the main include path
set_include_path(SITE_PATH);

// register the autoload
require_once('core/loader/Loader_Default.php');
spl_autoload_register(array('spiral\core\loader\Loader_Default', 'load'));
?>
