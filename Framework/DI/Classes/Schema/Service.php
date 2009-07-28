<?php
namespace Spiral\Framework\DI\Schema;

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
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Service extends Iterator, ArrayAccess
{
	/**
	 * Set the method to call
	 * 
	 * @param   \Spiral\Framework\DI\Schema\Method  $method
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
     * Tell if this service is a singleton or not
     * 
     * @return  void
     */
    public function isSingleton();

    /**
     * Set the factory method to use when calling this service
     *
     * @param   string  $factoryMethod
     */
    public function setFactoryMethod($factoryMethod);

    /**
     * Retreive the factory method used to eventually use the service as a
     * factory
     * 
     * @return  string
     */
    public function getFactoryMethod();
}
?>
