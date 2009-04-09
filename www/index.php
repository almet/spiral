<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\Core\Di\Container as Container;
require_once('../Core/ini.php');

$schema = new Schema();

$schema
->registerService('testClass', 'Spiral\\tests\\ToInject')
    ->onConstruct()->injectWith("content injected in youpi constructor \n", 'appel dynamique')
    ->onCall('myMethod')->injectWith('injection', 'de', 'methode dynamique')
    ->onStaticCall('Spiral\\tests\\Yataa', 'myStaticMethod')->injectWith(Schema::SELF)
    //->onCall('serviceNeeded')->injectWithServices('yataa')

->registerService('yataa', 'Spiral\\tests\\Yataa')

;
$container = new Container($schema);
$container->testClass->test();
?>
