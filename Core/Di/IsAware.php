<?php
namespace Spiral\Core\Di;
/**
 * Interface for objects that need to have an instance of the Injector
 */
interface IsAware{
    public function getDi($di);
}
?>
