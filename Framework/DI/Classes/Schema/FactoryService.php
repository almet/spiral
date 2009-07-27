<?php
/**
 * Represents a Service Factory for the Schema
 * 
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  AME 18 juin 2009
 */
class SpiralDi_Schema_Service_Factory extends SpiralDi_Schema_Service_Default{

    /**
     * constructor
     * 
     * @param   string  $name   service name
     * @param   string  $class  class name
     * @param   bool    $singleton
     */
    public function __construct($name, $class, $singleton){
        parent::__construct($name, $class, $singleton);
    }
}
?>
