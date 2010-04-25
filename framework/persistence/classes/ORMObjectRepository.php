<?php

namespace spiral\framework\persistence;

use \spiral\framework\persistence\orm\backend\StorageEngine;
use \spiral\framework\persistence\orm\meta\MetaConverter;
use \spiral\framework\persistence\orm\UnitOfWork;
use \spiral\framework\persistence\orm\IdentityMap;
use \spiral\framework\persistence\orm\OIDGenerator;
use \spiral\framework\persistence\query\Query;

/**
 * ORM object repository
 * 
 * This class implements an object-relational mapper under the {@link ObjectRepository} interface.
 * 
 * The ORM implementation is based on many Martin Fowler persistence patterns.
 * You can learn more on it at {@link http://martinfowler.com/eaaCatalog/}.
 * 
 * The {@link StorageEngine} is an adapter to a relational storage tool like a 
 * relational database management system (RDBMS). The communication with a {@link StorageEngine}
 * is done via {@link MetaObject}s that are relational representations of native objects.
 * 
 * The conversion from native object to {@link MetaObject} is done thanks to a {@link MetaConverter}
 * component which is also responsible of converting {@link MetaObject}s to native objects.
 * 
 * The {@link UnitOfWork} is responsible of managing objects status in order to persist objects and only
 * objects that need to.
 * 
 * The {@link IdentityMap} is a map of all native objects that belong to the repository.
 * 
 * The {@link OIDGenerator}'s role is to generate unique OIDs (as its name tells !).
 * 
 * TODO Talk about the QueryInterpreter
 * 
 * @see		StorageEngine
 * @see		MetaConverter
 * @see		UnitOfWork
 * @see		IdentityMap
 * @see		OIDGenerator
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 * @todo		Attributes should be initialized
 */
class ORMObjectRepository implements ObjectRepository
{
	/**
	 * Identity map
	 * 
	 * @var	IdentityMap
	 */
	private $_identityMap = null;
	
	/**
	 * Unit of work
	 * 
	 * @var	UnitOfWork
	 */
	private $_unitOfWork = null;
	
	/**
	 * Ensures that the repository contains the specified object.
	 * 
	 * If the repository does not contain the object yet, the object is made persistent and
	 * the OID associated to this object by the repository is returned.
	 * If the object is already registered in the repository, return the existing OID for this object.
	 * 
	 * FIXME The object will not be registered as dirty if it has changed.
	 * 
	 * @param	object	$object		The object to add
	 * @return	mixed	The OID associated to the object by the repository
	 */
	public function add($object)
	{
		// If object is already known, only return its OID
		if($this->_identityMap->containsObject($object))
		{
			// XXX Can check if the object has changed ? Just a proposition.
			return $this->_identityMap->findOIDByObject($object);
		}
		
		// If the object is not in the identity map, add it to the unit of work
		$oid = $this->_oidGenerator->generateOID($object);
		
		$this->_unitOfWork->add($oid, $object);
		$this->_identityMap->register($oid, $object);
		
		return $oid;
	}
	
	/**
	 * Remove an object from the repository
	 * 
	 * The object will be removed from the repository and will not be persistent anymore.
	 * If the object does not exists in the repository, nothing is done.
	 * 
	 * The object must have been loaded in the identity map (means via the {@link ObjectRepository}) before
	 * or it will not be removed.
	 * 
	 * @param	object	$object		The object to remove
	 * @return	void
	 */
	public function remove($object)
	{
		if($this->_identityMap->containsObject($object))
		{
			$oid = $this->_identityMap->findOIDByObject($object);
			$this->_unitOfWork->delete($oid, $object);
		}
	}
	
	/**
	 * Find an object in the repository by its OID
	 * 
	 * Return NULL if no object with this OID can be found.
	 * 
	 * @param	mixed			$oid		The OID of the object you want to find
	 * @return	object|NULL		The object corresponding to the OID or NULL if no object found
	 */
	public function findByOID($oid)
	{
		$object = $this->_identityMap->findObjectByOID($oid);
		
		// TODO Search in the storage engine too !
		
		return $object;
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
	 * @return	array	Array of objects matching the query
	 */
	public function findByQuery(Query $query)
	{
		// TODO Search in the storage engine
	}
}