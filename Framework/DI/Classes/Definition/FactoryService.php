<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents a Service Factory for the Schema
 * 
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 * @author  AME 18 juin 2009
 */
class Factoryservice extends DefaultService{
	
	/**
     * Default scope, when no scope specified
     * 
     * @var string
     */
    protected $_defaultScope = 'prototype';
    
    /**
     * Factory method to call for using the service as a factory
     *
     * @var string
     */
    protected $_factoryMethod = null;
    
    /**
     * constructor
     * 
     * @param   string  $name   service name
     * @param   string  $class  class name
     * @param   string	$scope
     */
    public function __construct($name, $class, $scope){
        parent::__construct($name, $class, $scope);
    }
    
	/**
     * Set the factory method to use when calling this service
     *
     * @param   string  $factoryMethod
     */
    public function setFactoryMethod($factoryMethod){
        $this->_factoryMethod = $factoryMethod;
    }

    /**
     * Retreive the factory method used to eventually use the service as a
     * factory
     *
     * @return  string
     */
    public function getFactoryMethod(){
        return $this->_factoryMethod;
    }
}
?>
