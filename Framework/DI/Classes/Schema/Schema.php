<?php

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
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	01 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface SpiralDi_Schema extends Iterator, ArrayAccess
{
	/**
	 * Constants that's represents the current resolved object.
	 */
	const   ACTIVE_SERVICE = 'SPIRAL_DI_ACTIVE_SERVICE';

	/**
	 * create and set the active object.
	 *
	 * @param	SpiralDi_Schema_Service	$service
	 * @param   string  $key
	 * @return  void
	 */
	public function addService(SpiralDi_Schema_Service $service, $key = null);
	
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
