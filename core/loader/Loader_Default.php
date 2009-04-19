<?php
namespace spiral\core\loader;

// the autoloader is dependant of these classes
require_once "Loader.php";
require_once "core/Exception.php";
require_once "exception/PathUnavailable.php";

/**
 * Load the classname thanks to the filesystem
 *
 * @author      Alexis Metaireau 	01 Apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.  
 */
class Loader_Default implements Loader{

    public static function load($className){
        $tab = explode('\\', str_replace('spiral\\','',$className));
        $path = SITE_PATH.implode(DIRECTORY_SEPARATOR, $tab) . '.php';
        if (!file_exists($path)){
            throw new exception\PathUnavailable($path);
        }
        require($path);
    }
}
?>
