<?php

namespace Spiral\Framework\Persistence;

use \Spiral\Framework\Persistence\ORM\Backend\StorageEngine;
use \Spiral\Framework\Persistence\ORM\Conversion\MetaConverter;
use \Spiral\Framework\Persistence\ORM\UnitOfWork;
use \Spiral\Framework\Persistence\Query\Query;

/**
 * ORM object repository
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class ORMObjectRepository implements ObjectRepository
{
	/**
	 * Meta converter
	 * 
	 * @var	MetaConverter
	 */
	private $_metaConverter = null;
	
	/**
	 * Storage engine
	 * 
	 * @var	StorageEngine
	 */
	private $_storageEngine = null;
	
	/**
	 * Unit of work
	 * 
	 * @var	UnitOfWork
	 */
	private $_unitOfWork = null;
	
	/**
	 * Meta objects identity map
	 * 
	 * @var	array
	 */
	private $_metaObjectsIdentityMap = array();
	
	/**
	 * Instances identity map
	 * 
	 * @var	array
	 */
	private $_instancesIdentityMap = array();
	
	/**
	 * Define the meta converter
	 * 
	 * @param	MetaConverter	$metaConverter
	 * 
	 * @return	void
	 */
	public function setMetaConverter(MetaConverter $metaConverter)
	{
		$this->_metaConverter = $metaConverter;
	}
	
	/**
	 * Define the storage engine
	 * 
	 * @param	StorageEngine	$storageEngine
	 * 
	 * @return	void
	 */
	public function setStorageEngine(StorageEngine $storageEngine)
	{
		$this->_storageEngine = $storageEngine;
	}
	
	/**
	 * Define the unit of work
	 * 
	 * @param	UnitOfWork	$unitOfWork
	 * 
	 * @return	void
	 */
	public function setUnitOfWork(UnitOfWork $unitOfWork)
	{
		$this->_unitOfWork = $unitOfWork;
	}
	
	/**
	 * Add an object to the repository
	 * 
	 * This method adds the object to the repository and make it persist.
	 * The OID associated to this object by the repository is returned.
	 * If the object is already registsred in the repository, return the internal OID of this object.
	 * 
	 * @param	object	$object		The object to add
	 * 
	 * @return	mixed	The OID associated to the object by the repository
	 */
	public function add($object)
	{
		$oid = array_search($object, $this->_instancesIdentityMap);
		
		// If object is not yet registered, add it
		if($oid === false)
		{
			$metaObject = $this->_metaConverter->convertToMetaObject($object);
			$oid = $this->_storageEngine->generateOID($metaObject);
			
			$this->_metaObjectsIdentityMap[$oid] = $metaObject;
			$this->_instancesIdentityMap[$oid] = $object;

			$this->_unitOfWork->registerNew($oid, $metaObject);
		}
		
		return $oid;
	}
	
	/**
	 * Remove an object from the repository
	 * 
	 * The object will be removed from the repository and will not be persistent anymore.
	 * If the object does not exists in the repository, nothing is done.
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
	 * @param	mixed			$oid		The OID of the object you want to find
	 * 
	 * @return	object|NULL					The object corresponding to the OID or NULL if no object found
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