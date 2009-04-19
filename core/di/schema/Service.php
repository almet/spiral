<?php
namespace spiral\core\di\schema;

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
 * $service->registerMethod($method);
 * </code>
 *
 * @author  	Alexis Métaireau    16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Service extends \Iterator, \ArrayAccess{

	/**
	 * Register a new service
	 * 
	 * @param	string	$serviceName
	 * @param	string	$className
	 */
	public function __construct($service, $className);

    /**
     * Set the method to call
     * 
     * @param   Method  $method
	 * @param	$key
     * @return  void
     */
    public function registerMethod(Method $method, $key = null);

    /**
     * Return the method corresponding to the name
     * 
     * @param	string      $name
     * @return	Method
	 * @throws	UnknownMethod
     */
    public function getMethod($name);
    
    /**
     * return the internal array of methods
     * 
     * @return Array
     */
    public function getRegistredMethods();

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
	 */
	public function setName($name);
}
?>
