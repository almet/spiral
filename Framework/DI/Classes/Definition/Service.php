<?php
namespace Spiral\Framework\DI\Definition;

use Spiral\Framework\DI\Construction;

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
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Service
{
	/**
	 * Set the method to call
	 * 
	 * @param   \Spiral\Framework\DI\Definition\Method  $method
	 * @param	$key
	 * @return  void
	 */
	public function addMethod(Method $method, $key = null);

	/**
	 * Return the method corresponding to the name
	 * 
	 * @param	string	  $name
	 * @return	Method
	 * @throws	UnknownMethod
	 */
	public function getMethod($name);
	
	/**
	 * return the internal array of methods
	 * 
	 * @return Array
	 */
	public function getMethods();

    /**
     * check if the method exists
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
     * @param string	$scope	singleton|prototype|session
     * @return unknown_type
     */
    public function setScope($scope=null);
    
	/**
     * return the construction strategy object
     * 
     * @return \Spiral\Framework\DI\Definition\ServiceConstructionStrategy
     */
    public function getConstructionStrategy();
    
    /**
     * Set the construction strategy object
     * 
     * @param 	\Spiral\Framework\DI\Construction\ServiceConstructionStrategy $context
     * @return 	void
     */
    public function setConstructionStrategy(Construction\ServiceConstructionStrategy $strategy);    
}
?>
