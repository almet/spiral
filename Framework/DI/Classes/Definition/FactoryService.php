<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents a Service Factory for the Schema
 * 
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 * @author  AME 18 juin 2009
 */
class Factoryservice extends DefaultService{

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
