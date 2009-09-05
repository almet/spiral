<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Construction;
use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Abstract method
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
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
     * scope of this service
     * 
     * @var string
     */
    protected $_scope;
    
    /**
     * Default scope, when no scope specified
     * 
     * @var string
     */
    protected $_defaultScope = 'singleton';
    
    /**
     * Return the service scope
     * 
     * @return string
     */
    public function getScope(){
    	return $this->_scope;
    }
    
    /**
     * Set the service scope
     * 
     * @param string	$scope	singleton|prototype|session
     * @return unknown_type
     */
    public function setScope($scope=null){
    	if ($scope === null){
    		$scope = $this->_defaultScope;
    	}
    	
    	$this->_scope = $scope;
    }
    
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
    	$strategy->setService($this);
    } 
}
?>
