<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction; 

/**
 * Default argument, corresponding to native php types.
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class DefaultArgument extends AbstractArgument implements Argument {
    
    /**
     * the value of the argument
     * @var     mixed
     */
    protected $_value;
    
    /**
     * the construction context used to build the argument
     * 
     * @var 	ConstructionContext
     */
    protected $_context;
    
    /**
     * constructor
     * @param   the value to be set
     * @return  void
     */
    public function __construct(){
        $this->_value = func_get_arg(0);
    }

    /**
     * return the argument value
     * 
     * @return  mixed
     */
    public function getValue(){
        return $this->_value;
    }
}
?>