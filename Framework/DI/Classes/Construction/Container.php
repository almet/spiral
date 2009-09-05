<?php
namespace Spiral\Framework\DI\Construction;
use \Spiral\Framework\DI\Definition\Schema;
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
 * $container = new Container($schema);
 * $service = $container->getService('serviceName');
 * // or using the magic __get method:
 * $serv = $container->serviceName;
 * </code>
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Container
{	
		
	/**
	 * Resolve all dependencies and return the 
	 * injected service object
	 *
	 * @param	string	$key
	 * @return	mixed
	 * @throws	\Spiral\Framework\DI\Definition\Exception\UnknownServiceException
	 */
	public function getService($key);

	/**
     * Add a builded service to the container, this service will be shared, and reused
     * 
     * Directly add object into the Container (bypassing the Schema)
     * Overwrite the Schema configuration
     *    
     * @param 	string	$serviceName
     * @param 	object	$service
     * @return 	\Spiral\Framework\DI\Construction\DefaultContainer
     */
    public function addSharedService($serviceName, $service);
    
    /**
     * Check if service has been shared
     * 
     * @param 	string	$serviceName
     * @return 	bool
     */
    public function hasSharedService($serviceName);
    
    /**
     * Return, if exists, the asked shared service
     * 
     * @param 	string	$serviceName
     * @return 	mixed
     */
    public function getSharedService($serviceName);

    /**
     * Magic method get.
     *
     * Alias of getService()
     */
    public function __get($key);

    /**
     * Magic method set.
     *
     * Alias of setService()
     * @param   string  $key
     * @param   object  $service
     */
    public function __set($key, $service);

    /**
     * Magic method isset.
     * 
     * @param   string  $key
     * @return  boolean
     */
    public function __isset ($key);
    
}
?>
