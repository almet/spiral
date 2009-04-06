<?php
require_once('../Core/ini.php');
$appFactory = new Spiral\Core\Di\Container();

$appFactory->forObject('test', 'Spiral\\tests\\Youpi')
    ->construct()->with('constructor of Youpi..')
    ->inject('sayYoupi')->with('youpi', 'youpa', 'youpo');

$appFactory->get('test');
?>
