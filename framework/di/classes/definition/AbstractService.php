<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\ServiceConstructionStrategy;
use \spiral\framework\di\construction\Container;

/**
 * Abstract method
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractService implements Service
{	
	/**
     * The construction strategy used to build the argument
     * 
     * @var ServiceConstructionStrategy
     */
    protected $_strategy;
    
    /**
     * Scope of this service
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
     * Default constructor method 
     * 
     * @var DefaultMethod
     */
    protected $_defaultConstructor;
    
    /**
     * Return the service scope
     * 
     * @return string
     */
    public function getScope()
    {
    	return $this->_scope;
    }
    
    /**
     * Set the service scope
     * 
     * @param	string	$scope	singleton|prototype|session
     * @return	void
     */
    public function setScope($scope=null)
    {
    	if ($scope === null)
    	{
    		$scope = $this->_defaultScope;
    	}
    	
    	$this->_scope = $scope;
    }
    
	/**
     * return the construction strategy object
     * 
     * @return ServiceConstructionStrategy
     */
    public function getConstructionStrategy()
    {
    	return $this->_strategy;
    }
    
    /**
     * Set the construction strategy object
     * 
     * @param 	ServiceConstructionStrategy		$strategy
     * @return 	void
     */
    public function setConstructionStrategy(ServiceConstructionStrategy $strategy)
    {
    	$strategy->setService($this);
    	$this->_strategy = $strategy;
    }

	/**
	 * Alias Method for building service
	 *
	 * @param	Schema		$schema
	 * @param	Container	$container
	 * @return	mixed
	 */
	public function buildService(Schema $schema, Container $container)
	{
		return $this->getConstructionStrategy()->buildService($schema, $container);
	}
}
