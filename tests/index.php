<?php
use spiral\core\di\Schema as Schema;
use spiral\core\di\Container as Container;
require_once('../core/ini.php');
try{
    
    $schema = new Schema();

    $schema
    ->registerService('testClass', 'spiral\tests\ToInject')
        ->onConstruct()->injectWith("content injected in youpi constructor \n", 'appel dynamique')
        ->onCall('myMethod')->injectWith('injection', 'de', 'methode dynamique')
        ->onStaticCall('spiral\tests\yataa', 'myStaticMethod')->injectWith(Schema::ACTIVE_SERVICE)
        ->onCall('serviceNeeded')->injectWithServices('yataa')

    ->registerService('yataa', 'spiral\tests\Yataa')

    ;
    $container = new Container($schema);
    $container->testClass->test();
} catch(\spiral\core\Exception $e){
    $e->display();
}
?>
