<?php
namespace Spiral\tests;

class Youpi{
    public function __construct($a = null){
        var_dump($a);
        echo "youpi !";
    }
    
    public function sayYoupi($a, $b, $c){
        var_dump($a, $b, $c);
    }
}
?>
