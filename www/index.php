<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\Core\Di\Container as Container;
require_once('../Core/ini.php');

$schema = new Schema();

$schema
->registerService('testClass', 'Spiral\Tests\ToInject')
    ->onConstruct()->injectWith("content injected in youpi constructor \n", 'appel dynamique')
    ->onCall('myMethod')->injectWith('injection', 'de', 'methode dynamique')
    ->onStaticCall('Spiral\Tests\Yataa', 'myStaticMethod')->injectWith(Schema::SELF)
    //->onCall('serviceNeeded')->injectWithServices('yataa')

->registerService('yataa', 'Spiral\Tests\Yataa')

;
$container = new Container($schema);
$container->testClass->test();
?>
