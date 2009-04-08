<?php
namespace Spiral\tests;

class ToInject{
    protected $_dynamicContent;
    
    public function __construct($injectedContent, $dynamicContent){
        echo($injectedContent);
        $this->_dynamicContent = $dynamicContent;
    }
    
    public function myMethod($a, $b, $c){
        var_dump($a, $b, $c);
    }
    
    public function test(){
        // display now the dynamic content
        echo $this->_dynamicContent;
    }
}
?>
