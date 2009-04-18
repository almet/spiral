<?php
namespace spiral\core\di\schema;

/**
 * Service interface
 *
 * @author  Alexis Métaireau    16 apr. 2009
 */
interface Service {

	/**
	 * Register a new service
	 * 
	 * @param	string	$serviceName
	 * @param	string	$className
	 */
	public function __construct($serviceName, $className);

    /**
     * Set the method to call
     * 
     * @param   string  $name
     * @param   Method  $method
     * @return  void
     */
    public function registerMethod($name, Method $method);

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
	public function getServiceName();
}
?>
