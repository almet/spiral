<?php
namespace Spiral\tests;

/**
 * Yataa
 * Test class for static calls
 * 
 * @author    Alexis Métaireau    8 Apr. 2009
 */

class Yataa
{    
    public static function myStaticMethod(Youpi $obj){
        echo 'la methode statique à bien été apellée avec l\'objet '.get_class($obj).' en parametre';
    }
}
?>
