<?php
namespace spiral\core\di;

/**
 * Interface for objects that need to have an instance of the Injector
 */
interface IsAware{
    public function getDi($di);
}
?>
