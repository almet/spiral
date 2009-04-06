<?php 
$container = new DiContainer();
$container->forObject('mysqlDb', 'Database')
    ->constructWith(array('host'=> 'localhost', 'login'=>'root', 'password'=>''));
    
//is just like
    ->inject('__construct')->with(array('host'=> 'localhost', 'login'=>'root', 'password'=>''));
?>
