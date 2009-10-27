<?php

namespace spiral\framework\di\definition;

use \spiral\framework\di\construction\Container;
use \spiral\framework\di\construction\ServiceConstructionStrategy;
use \spiral\framework\di\definition\exception\UnknownMethodException;

/**
 * Service interface
 *
 * A service represents a way to instanciate a class, so it's composed of
 * - a service name
 * - a class name
 * - some methods objects
 *
 * It's just a container useful to describe how a service must be build
 * 
 * Here's an exemple of use:
 *
 * <code>
 * $service = new Service('serviceName', 'className');
 * // supposing that $method is a Method instance
 * $service->addMethod($method);
 * </code>
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Service
{
	/**
	 * Set the method to call
	 * 
	 * @param   Method  $method
	 * @param	string	$key
	 * @return  void
	 */
	public function addMethod(Method $method, $key = null);

	/**
	 * Return the method corresponding to the name
	 * 
	 * @param	string	  $name
	 * @return	Method
	 * @throws	UnknownMethodException
	 */
	public function getMethod($name);
	
	/**
	 * Return the internal array of methods
	 * 
	 * @return array
	 */
	public function getMethods();

    /**
     * Check if the method exists
     *
     * @param   string  $method
     * @return  bool
     */
    public function hasMethod($method);

	/**
	 * Return the classname
	 * 
	 * @return	string
	 */
	public function getClassName();

	/**
	 * Return the service name
	 * 
	 * @return	string
	 */
	public function getName();

	/**
	 * Set the service name
	 * 
	 * @param	string	$name
     * @return  void
	 */
	public function setName($name);

	/**
     * Return the service scope
     * 
     * @return string
     */
    public function getScope();
    
    /**
     * Set the service scope
     * 
     * @param	string	$scope	singleton|prototype|session
     * @return	void
     */
    public function setScope($scope=null);
    
	/**
     * Return the construction strategy object
     * 
     * @return ServiceConstructionStrategy
     */
    public function getConstructionStrategy();
    
    /**
     * Set the construction strategy object
     * 
     * @param 	ServiceConstructionStrategy $strategy
     * @return 	void
     */
    public function setConstructionStrategy(ServiceConstructionStrategy $strategy);

	/**
	 * Alias Method for building service
	 *
	 * @param	Schema 		$schema
	 * @param	Container	$container
	 * @return	mixed
	 */
	public function buildService(Schema $schema, Container $container);
}
