<?php

namespace Spiral\Framework\Persistence;

use \Spiral\Framework\Persistence\Backend\StorageEngine;
use \Spiral\Framework\Persistence\Introspection\ObjectIntrospector;

/**
 * Default object repository
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class ORMObjectRepository implements ObjectRepository
{
	/**
	 * Object introspector
	 * 
	 * @var	ObjectIntrospector
	 */
	private $_objectIntrospector;
	
	/**
	 * Storage engine
	 * 
	 * @var	StorageEngine
	 */
	private $_storageEngine;
	
	/**
	 * Set the object introspector
	 * 
	 * @param	ObjectIntrospector	$objectIntrospector
	 * 
	 * @return	void
	 */
	public function setObjectIntrospector(ObjectIntrospector $objectIntrospector);
	
	/**
	 * Set the storage engine
	 * 
	 * @param	StorageEngine	$storageEngine
	 * 
	 * @return	void
	 */
	public function setStorageEngine(StorageEngine $storageEngine);
	
	/**
	 * Add an object to the repository
	 * 
	 * @param	object	$object		The object to add
	 * 
	 * @return	mixed	The OID
	 * 
	 * @todo	Define the type for OIDs
	 */
	public function add($object)
	{
		$metaObject = $this->_objectIntrospector->buildMetaObject($object);
		return $this->_storageEngine->store($metaObject);
	}
	
	/**
	 * Remove an object from the repository
	 * 
	 * @param	object	$object		The object to remove
	 * 
	 * @return	void
	 */
	public function remove($object)
	{
	}
	
	/**
	 * Find an object in the repository by its OID
	 * 
	 * Return null if no object with this OID can be found.
	 * 
	 * @param	mixed	$oid		The OID of the object you want to find
	 * 
	 * @return	object|NULL			The object corresponding to the OID or NULL if no object found
	 */
	public function findByOID($oid)
	{
	}
	
	/**
	 * Find objects in the repository using a query
	 * 
	 * Return an array containing all objects that match the query.
	 * The array can be empty if no object can be found.
	 * 
	 * @see		Query
	 * 
	 * @param	Query	$query		Query that you want to execute
	 * 
	 * @return	array	Array of objects matching the query
	 */
	public function findByQuery(Query $query)
	{
	}
}