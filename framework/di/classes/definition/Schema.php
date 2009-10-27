<?php

namespace spiral\framework\di\definition;

/**
 * Schema interface
 *
 * The Schema is a representation of all dependencies between services and 
 * arguments etc.
 * 
 * It contains Services, and can add it, to give back information about 
 * them later. So, this is just a storage class.
 *
 * You can note that the Schema interface extends Iterator, ArrayAccess
 * and Countable interfaces, in order to be easy to use and to iterate.
 *
 * Here is an exemple of use:
 * <code>
 * // with $service and $anotherService as Service
 * $schema->addService($service);
 * $schema->addService($anotherService);
 * 
 * // and, when needed, the schema object can return all registred services:
 * $schema->Services();
 * // or, with a foreach statement:
 * foreach($schema as $service)
 * {
 *  	// do some stuff with the service object.
 * }
 * </code>
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Schema
{
	/**
	 * Create and set the active object.
	 *
	 * @param	Service	$service
	 * @param   string  $key
	 * @return  void
	 */
	public function addService(Service $service, $key = null);
	
	/**
	 * Add many services in one time
	 *
	 * Each element of array must be an instance of Service.
	 *
	 * @param	array	$services
	 * @return  void
	 */
	public function addServices(array $services);
	
	/**
	 * Return a registred service
	 *
	 * @param	string	$key
	 * @return	mixed
	 */
	public function getService($key);

	/**
	 * Return an array of all registred services
	 *
	 * @return  array
	 */
	public function getServices();
	
	/**
	 * Return if a service is registred
	 * 
	 * @param	string	$key
	 * @return	bool
	 */
	public function hasService($service);
}
