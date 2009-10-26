<?php

namespace spiral\framework\di\construction;

use \spiral\framework\bootstrap\Loader;
use \spiral\framework\di\definition\Schema;
use \spiral\framework\di\definition\exception\UnknownServiceException;

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
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Container
{	
	/**
	 * Resolve all dependencies and return the 
	 * injected service object
	 *
	 * @param	string	$key
	 * @return	mixed
	 * @throws	UnknownServiceException
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
     * @return 	DefaultContainer
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
