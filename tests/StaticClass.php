<?php
namespace spiral\tests;

/**
 * Yataa
 * Test class for static calls
 * 
 * @author    Alexis Métaireau    8 Apr. 2009
 */

class StaticClass
{    
    public static function myStaticMethod(Service $obj){
        echo "la methode statique à bien été apellée avec l'objet ".get_class($obj)." en parametre \n";
    }
}
?>
