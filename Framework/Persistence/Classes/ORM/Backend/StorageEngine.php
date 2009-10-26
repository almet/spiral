<?php

namespace Spiral\Framework\Persistence\ORM\Backend;

use Spiral\Framework\Persistence\ORM\MetaObject;

/**
 * Storage engine
 * 
 * The storage engine is responsible of storing meta object representations in a persistent support.
 * For example, a typical storage engine is an adapter to a relational database.
 * 
 * The storage engine is also the component responsible of generating OID.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
interface StorageEngine
{
	/**
	 * Delete the meta object associaed to the oid in the storage engine
	 * 
	 * @param	mixed		$oid			OID
	 * 
	 * @return	void
	 */
	public function delete($oid);
	
	/**
	 * Generate an OID for the given meta object
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * 
	 * @return	mixed		OID
	 */
	public function generateOID(MetaObject $metaObject);
	
	/**
	 * Insert the meta object in the storage engine
	 * 
	 * @param	mixed		$oid			OID
	 * @param	MetaObject	$metaObject		Meta object
	 * 
	 * @return	void
	 */
	public function insert($oid, MetaObject $metaObject);
	
	/**
	 * Uodate the meta object in the storage engine
	 * 
	 * @param	mixed		$oid			OID
	 * @param	MetaObject	$metaObject		Meta object
	 * 
	 * @return	void
	 */
	public function update($oid, MetaObject $metaObject);
}
