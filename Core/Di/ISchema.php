<?php
namespace Spiral\Core\Di;
/**
 * Interface for a Schema class
 *
 * @package     Spiral/Core/Di
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
interface ISchema{
    public function forObject($key, $className);
    public function inject($methodName);
    public function addArgument($argument);
    public function setArguments($arguments);
    public function construct();
    public function with();
    public function addMethodCall($method, $key);
    public function addStaticMethodCall($method, $class);    
    public function getElement($key);
}
?>
