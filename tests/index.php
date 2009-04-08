<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\tests\Youpa as Youpa;
require_once('../Core/ini.php');
$schema = new Schema();

$schema->registerService('testClass', 'Spiral\\tests\\ToInject')
    ->onConstruct()->injectWith("content injected in youpi constructor \n", 'appel dynamique')
    ->onCall('myMethod')->injectWith('injection', 'de', 'methode dynamique')
    ->onStaticCall('Spiral\\tests\\Yataa', 'myStaticMethod')->injectWith(Schema::SELF)
;
$container = new Spiral\Core\Di\Container($schema);
$injectedObject = $container->testClass;
$injectedObject->test();
?>
