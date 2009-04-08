<?php
namespace Spiral\tests;

class Youpi{
    public function __construct($a = null){
        var_dump($a);
        echo "youpi !";
    }
    
    public function myMethod($a, $b, $c){
        var_dump($a, $b, $c);
    }
    
    public function test(){
        echo "le callStatic fonctionne";
    }
}
?>
