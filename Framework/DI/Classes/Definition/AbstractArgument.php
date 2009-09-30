<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction; 

/**
 * Abstract argument 
 *
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractArgument {
    
    /**
     * the construction strategy used to build the argument
     * 
     * @var 	\Spiral\Framework\DI\Definition\ArgumentConstructionStrategy
     */
    protected $_strategy;
    
    /**
     * return the construction strategy object
     * 
     * @return \Spiral\Framework\DI\Definition\ArgumentConstructionStrategy
     */
    public function getConstructionStrategy(){
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	\Spiral\Framework\DI\Construction\ArgumentConstructionStrategy $context
     * @return 	void
     */
    public function setConstructionStrategy(Construction\ArgumentConstructionStrategy $strategy){
    	$strategy->setArgument($this);
		$this->_strategy = $strategy;
    }
}
?>
