<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\tests\Youpa as Youpa;
require_once('../Core/ini.php');
$schema = new Schema();

$schema->forObject('testClass', 'Spiral\\tests\\ToInject')
    ->construct()->with("content injected in youpi constructor \n", 'appel dynamique')
    ->call('myMethod')->with('injection', 'de', 'methode dynamique')
    ->callStatic('Spiral\\tests\\Yataa', 'myStaticMethod')->with(Schema::SELF)
;
$container = new Spiral\Core\Di\Container($schema);
$injectedObject = $container->testClass;
$injectedObject->test();
?>
