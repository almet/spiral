<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\tests\Youpa as Youpa;
require_once('../Core/ini.php');
$schema = new Schema();

$schema->forObject('testClass', 'Spiral\\tests\\ToInject')
    ->construct()->with('content injected in youpi constructor', 'tentative d\'appel dynamique')
    ->call('myMethod')->with('youpi', 'youpa', 'youpo')
    ->callStatic('Spiral\\tests\\Yataa', 'myStaticMethod')->with(Schema::SELF)
;
$container = new Spiral\Core\Di\Container($schema);
$injectedObject = $container->testClass;
$injectedObject->test();
?>
