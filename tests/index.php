<?php
use Spiral\Core\Di\Schema as Schema;
use Spiral\test\Youpa as Youpa;
require_once('../Core/ini.php');
$schema = new Schema();

$schema->forObject('youpi', 'Spiral\\tests\\Youpi')
    ->construct()->with('constructor of Youpi..')
    ->call('myMethod')->with('youpi', 'youpa', 'youpo')
    //->callStatic('Spiral\\tests\\Yataa', 'myStaticMethod')->with(Schema::SELF)
;
$container = new Spiral\Core\Di\Container($schema);
Youpa::myStaticMethod();
?>
