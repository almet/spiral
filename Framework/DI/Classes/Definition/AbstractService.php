<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction;
use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Abstract method
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
abstract class AbstractService
{	
	/**
     * the construction strategy used to build the argument
     * 
     * @var 	\Spiral\Framework\DI\Definition\MethodConstructionStrategy
     */
    protected $_strategy;
    
	/**
     * return the construction strategy object
     * 
     * @return \Spiral\Framework\DI\Definition\ServiceConstructionStrategy
     */
    public function getConstructionStrategy(){
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	\Spiral\Framework\DI\Construction\ServiceConstructionStrategy $context
     * @return 	void
     */
    public function setConstructionStrategy(Construction\ServiceConstructionStrategy $strategy){
    	$this->_strategy = $strategy;
    }   
}
?>
