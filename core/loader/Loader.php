<?php
namespace spiral\core\loader;
/**
 * Find and load a class thanks to her name
 *
 * 
 * @author      Alexis Metaireau 01 Apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.  
 */
interface Loader{

    /**
     * Try to load the given classname
     *
     * @param   string  $className
     * @return  void
     * @throws	PathUnavailable
     */
    public static function load($className);
}
?>
