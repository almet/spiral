<?php
namespace Spiral\Core\Di;
/**
 * Interface for a Schema class
 *
 * @package     Spiral/Core/Di
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
interface ISchema{
    public function registerService($key, $className);
    public function onCall($methodName);
    public function onStaticCall($className, $methodName);
    public function addArgument($argument);
    public function setArguments($arguments);
    public function onConstruct();
    public function injectWith();
    public function getElement($key);
}
?>
