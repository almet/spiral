<?php

namespace spiral\framework\di\definition;

/**
 * Represents a Service Factory for the Schema
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class Factoryservice extends DefaultService
{
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
     * Constructor
     * 
     * @param   string  $name   service name
     * @param   string  $class  class name
     * @param   string	$scope
     * @return	void
     */
    public function __construct($name, $class, $scope)
    {
        parent::__construct($name, $class, $scope);
    }
    
	/**
     * Set the factory method to use when calling this service
     *
     * @param   string  $factoryMethod
     * @return	void
     */
    public function setFactoryMethod($factoryMethod)
    {
        $this->_factoryMethod = $factoryMethod;
    }

    /**
     * Retreive the factory method used to eventually use the service as a factory
     *
     * @return  string
     */
    public function getFactoryMethod()
    {
        return $this->_factoryMethod;
    }
}
