<?php
namespace Spiral\Core\Di;
/**
 * Interface for a Schema class
 *
 * @package     Spiral/Core/Di
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
interface Schema{
    // required methods
    public function registerService($key, $className);
    public function onCall($methodName);
    public function onStaticCall($className, $methodName);
    public function addArgument($argument, $asService);
    public function setArguments($arguments, $asServices);
    public function getElement($key);
    
    // facilities
    public function onConstruct();    
    public function injectWith();    
    public function injectWithServices();
    public function addArgumentAsService($argument);
    public function setArgumentsAsServices($arguments);    
}
?>
