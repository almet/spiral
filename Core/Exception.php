<?php
namespace Spiral\Core;
/**
 * Description of Exception
 *
 * @author ametaireau 9 avr. 2009
 */
class Exception extends \Exception{
    public function display(){
        echo '<h2>',get_class($this),'</h2>';
        echo $this->getMessage();
        echo '<h3>Trace:</h3><pre>',$this->getTraceAsString(),'</pre>';
    }
}