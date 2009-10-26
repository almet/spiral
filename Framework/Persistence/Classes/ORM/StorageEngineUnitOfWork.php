<?php

namespace Spiral\Framework\Persistence\ORM;

use Spiral\Framework\Persistence\ORM\Backend\StorageEngine;

/**
 * Unit of work that commits to a storage engine
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class StorageEngineUnitOfWork extends AbstractUnitOfWork
{
	/**
	 * Storage engine
	 * 
	 * @var	StorageEngine
	 */
	private $_storageEngine = null;
	
	/**
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	protected function _commit()
	{
		// Insert new objects
		foreach($this->_newObjects as $oid=>$object)
		{
			$this->_storageEngine->insert($oid, $object);
		}
		
		// Update dirty objects
		foreach($this->_dirtyObjects as $oid=>$object)
		{
			$this->_storageEngine->update($oid, $object);
		}
		
		// Delete deleted objects
		foreach($this->_deletedObjects as $oid)
		{
			$this->_storageEngine->delete($oid);
		}
	}
	
	/**
	 * Define the storage engine
	 * 
	 * @param	StorageEngine	$storageEngine		Storage engine
	 * 
	 * @return	void
	 */
	public function setStorageEngine(StorageEngine $storageEngine)
	{
		$this->_storageEngine = $storageEngine;
	}
}