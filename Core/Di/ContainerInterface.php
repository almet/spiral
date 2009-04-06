<?php
namespace Spiral\Core\Di;
/**
 * Define the interface of a DiContainer
 * Class
 *
 * @package     spiral
 * @supbpackage DI
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
interface ContainerInterface{
    public function forObject($key, $className);
    public function inject($methodName);
    public function addArgument($argument);
    public function setArguments($arguments);
    public function construct();
    public function with();
}
?>
