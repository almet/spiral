<?php

namespace spiral\framework\persistence\orm;

use \spiral\framework\persistence\orm\backend\StorageEngine;
use \spiral\framework\persistence\orm\meta\MetaConverter;

/**
 * Unit of work that commits to a storage engine
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class StorageEngineUnitOfWork extends AbstractUnitOfWork
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
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	protected function _commit()
	{
		$statusOperationMap[self::_STATUS_NEW] = 'insert';
		$statusOperationMap[self::_STATUS_DIRTY] = 'update';
		$statusOperationMap[self::_STATUS_DELETED] = 'delete';
		
		foreach($this->_objectsStatus as $oid=>$status)
		{
			$object = $this->_objects[$oid];
			$metaObject = $this->_metaConverter->convertToMetaObject($object, $oid);
			
			$operation = $statusOperationMap[$status];
			$this->_storageEngine->$operation($metaObject);
		}
	}
	
	/**
	 * Define the meta converter
	 * 
	 * @param	MetaConverter	$metaConverter		Meta converter
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
	 * @param	StorageEngine	$storageEngine		Storage engine
	 * 
	 * @return	void
	 */
	public function setStorageEngine(StorageEngine $storageEngine)
	{
		$this->_storageEngine = $storageEngine;
	}
}