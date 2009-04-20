<?php
namespace spiral\core\di\schema;

/**
 * Schema interface
 *
 * The Schema is a representation of all dependencies between services and 
 * arguments etc.
 * 
 * It contains Services, and can register it, to give back information about 
 * them later. So, this is just a storage class.
 *
 * You can note that the Schema interface extends Iterator, ArrayAccess
 * and Countable interfaces, in order to be easy to use and to iterate.
 *
 * Here is an exemple of use:
 * <code>
 * // with $service and $anotherService as Service
 * $schema->registerService($service);
 * $schema->registerService($anotherService);
 * 
 * // and, when needed, the schema object can return all registred services:
 * $schema->getRegistredServices();
 * // or, with a foreach statement:
 * foreach($schema as $service){
 *  	// do some stuff with the service object.
 * }
 * </code>
 *
 * @author  	Alexis Métaireau	01 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Schema extends \Iterator, \ArrayAccess{
	/**
	 * Constants that's represents the current resolved object.
	 */
	const   ACTIVE_SERVICE = 'SPIRAL_DI_ACTIVE_SERVICE';

	/**
	 * create and set the active object.
	 *
	 * @param	Service	$service
	 * @param   string  $key
	 * @return  void
	 */
	public function registerService(Service $service, $key = null);
	
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
	public function getRegistredServices();
}
?>
