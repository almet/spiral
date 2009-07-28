<?php
namespace \Spiral\Framework\DI\Container;
use \Spiral\Framework\DI\Schema\Schema;
use \Spiral\Framework\Bootstrap\Loader;

/**
 * Interface for the Di Container
 *
 * The aim of a Di Container is to build an object from classes contained in a 
 * schema object, and to inject it's methods and properties, according to the 
 * schema.
 *
 * To load the good class before instantiate it, the container can use a loader
 *
 * Here is a way to use it:
 * 
 * <code>
 * $container = new ContainerImplementation($schema);
 * $service = $container->getService('serviceName');
 * // Or using the magic __get method :
 * $service = $container->serviceName;
 * </code>
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Container
{
	/**
	 * Alias of getService().
	 * 
     * @param   string  $serviceName
     * 
     * @return  object
	 */
	public function __get($serviceName);

    /**
	 * Alias of hasService().
	 * 
     * @param   string  $serviceName
     * 
     * @return  boolean
     */
    public function __isset($serviceName);
    
    /**
	 * Alias of setService().
	 * 
     * @param   string  $serviceName
     * @param   object  $service
     * 
     * @return	void
     */
    public function __set($serviceName, $service);

	/**
	 * Resolve all dependencies and return the 
	 * injected service object.
	 *
	 * @param	string	$serviceName
	 * 
	 * @return	object
	 */
	public function getService($serviceName);
    
    /**
     * Return if the container contains the service corresponding to the serviceName.
     *
     * @param	string	$serviceName
     * 
     * @return	boolean
     */
    public function hasService($serviceName);
    
    /**
     * Directly add an object into the Container (bypassing the Schema).
     *
     * Overwrite the Schema configuration.
     *
     * @param	string	$serviceName
     * @param	object	$service
     * 
     * @return	void
     */
    public function setService($serviceName, $service);
}
