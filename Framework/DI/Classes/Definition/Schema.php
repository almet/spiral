<?php
namespace Spiral\Framework\DI\Definition;

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
 * foreach($schema as $service){
 *  	// do some stuff with the service object.
 * }
 * </code>
 *
 * @author  	Alexis Métaireau	01 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Schema
{

	/**
	 * create and set the active object.
	 *
	 * @param	\Spiral\Framework\DI\Definition\Service	$service
	 * @param   string  $key
	 * @return  void
	 */
	public function addService(Service $service, $key = null);
	
	/**
	 * add many services in one time
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
	 * @return  Array
	 */
	public function getServices();
	
	/**
	 * Return if a service is registred
	 * 
	 * @return	bool
	 */
	public function hasService($service);
}
?>
