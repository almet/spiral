<?php
//namespace Spiral\Core\Loader;
/**
 * Autoloader of spiral files
 * Use the namespaces
 *
 * @package     Spiral
 * @subpackage  Loader
 * @author      Alexis Metaireau 01 Apr. 2009
 */
class FileSystem{

    /**
     * the autoload method
     *
     * @param   string  $className
     * @return  void
     */
    public static function autoload($className){
        $tab = explode('\\', str_replace('Spiral\\','',$className));
        $path = SITE_PATH.implode(DIRECTORY_SEPARATOR, $tab) . '.php';
        if (!file_exists($path)){
            throw new \Spiral\Core\Exception('Unable to load '.$className.' path '.$path.' doesnt exists');
        }
        require($path);
    }
}
?>
