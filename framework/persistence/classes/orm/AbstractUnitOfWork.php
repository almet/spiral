<?php

namespace spiral\framework\persistence\orm;

/**
 * Abstract unit of work
 * 
 * This component manages objects status changes.
 * See methods documentation to learn how status are updated.
 * 
 * Note on the implementation:
 * 	- This implementation is directly dependent from OID classification
 * 		which means that the OID is used to identify an object and not the reference
 * 		as it could be thought.
 * 	- OIDs are considered to be scalar values.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractUnitOfWork implements UnitOfWork
{
	/**
	 * Internal status constants
	 * 
	 * @var string
	 */
	const _STATUS_NEW = 'new';
	const _STATUS_DIRTY = 'dirty';
	const _STATUS_DELETED = 'deleted';
	const _STATUS_CLEAN = 'clean';
	
	/**
	 * Objects collection
	 * 
	 * @var	array
	 */
	protected $_objects = array();
	
	/**
	 * Objects status collection
	 * 
	 * @var	array
	 */
	protected $_objectsStatus = array();
	
	/**
	 * Previous objects status collection
	 * 
	 * @var	array
	 */
	protected $_previousObjectsStatus = array();
	
	/**
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	public function commit()
	{
		$this->_commit();
		$this->_cleanUp();
	}
	
	/**
	 * Rollback all operations
	 * 
	 * @return	void
	 */
	public function rollback()
	{
		$this->_cleanUp();
	}
	
	/**
	 * Add an object
	 * 
	 * Here is the table of applied status modifications:
	 * ---------------------------------------------------------------------------------
	 * | Initial status | New status     | Comment                                     |
	 * ---------------------------------------------------------------------------------
	 * | clean          | new            | Simply register new status                  |
	 * | dirty          | ???            | Impossible situation, can't insert a        |
	 * |                |                |  registered object                          |
	 * | deleted        | clean or dirty | Recover previous status                     |
	 * ---------------------------------------------------------------------------------
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function add($oid, $object)
	{
		$currentStatus = $this->_getObjectStatus($oid, $object);
		
		switch($currentStatus)
		{
			case self::_STATUS_DELETED:
				if($this->_getPreviousObjectStatus($oid, $object) === self::_STATUS_DIRTY)
				{
					$newStatus = self::_STATUS_DIRTY;
				}
				else
				{
					$newStatus = self::_STATUS_CLEAN;
				}
				break;
				
			default:
				$newStatus = self::_STATUS_NEW;
				break;
		}
		
		$this->_setObjectStatus($oid, $object, $newStatus);
	}
	
	/**
	 * Update an object
	 * 
	 * Here is the table of applied status modifications:
	 * ---------------------------------------------------------------------------------
	 * | Initial status | New status     | Comment                                     |
	 * ---------------------------------------------------------------------------------
	 * | clean          | dirty          | Simply register new status                  |
	 * | new            | new            | Since the object is not yet registered in   |
	 * |                |                |  the storage engine, an insert will save    |
	 * |                |                |  dirty values as well                       |
	 * | deleted        | deleted        | The object is supposed to be deleted so     |
	 * |                |                |  changes have no importance                 |
	 * ---------------------------------------------------------------------------------
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function update($oid, $object)
	{
		$currentStatus = $this->_getObjectStatus($oid, $object);
		
		switch($currentStatus)
		{
			case self::_STATUS_NEW:
				$newStatus = self::_STATUS_NEW;
				break;
				
			case self::_STATUS_DELETED:
				$newStatus = self::_STATUS_DELETED;
				break;
				
			default:
				$newStatus = self::_STATUS_DIRTY;
				break;
		}
		
		$this->_setObjectStatus($oid, $object, $newStatus);
	}
	
	/**
	 * Delete an object
	 * 
	 * Here is the table of applied status modifications:
	 * ---------------------------------------------------------------------------------
	 * | Initial status | New status     | Comment                                     |
	 * ---------------------------------------------------------------------------------
	 * | clean          | deleted        | Simply register new status                  |
	 * | new            | clean          | Deleting a new object means to do nothing   |
	 * |                |                |  at the end                                 |
	 * | dirty          | deleted        | Do not take care of changes anymore since   |
	 * |                |                |  we want to delete the object               |
	 * ---------------------------------------------------------------------------------
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function delete($oid, $object)
	{
		$currentStatus = $this->_getObjectStatus($oid, $object);
		
		switch($currentStatus)
		{
			case self::_STATUS_NEW:
				$newStatus = self::_STATUS_CLEAN;
				break;
				
			default:
				$newStatus = self::_STATUS_DELETED;
				break;
		}
		
		$this->_setObjectStatus($oid, $object, $newStatus);
	}
	
	/**
	 * Make an object clean
	 * 
	 * The object is made clean whatever the current status.
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function clean($oid, $object)
	{
		$this->_setObjectStatus($oid, $object, self::_STATUS_CLEAN);
	}
	
	/**
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	abstract protected function _commit();
	
	/**
	 * Clean up object collections
	 * 
	 * @return	void
	 */
	private function _cleanUp()
	{
		$this->_objects = array();
		$this->_objectsStatus = array();
		$this->_previousObjectsStatus = array();
	}
	
	/**
	 * Define the new status of an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object which status has to be set
	 * @param	string	$status		New status
	 * @return	void
	 */
	private function _setObjectStatus($oid, $object, $status)
	{
		$this->_previousObjectsStatus[$oid] = $this->_getObjectStatus($oid, $object);
		
		if($status === self::_STATUS_CLEAN)
		{
			unset($this->_objectsStatus[$oid]);
			unset($this->_objects[$oid]);
		}
		else
		{
			$this->_objectsStatus[$oid] = $status;
			$this->_objects[$oid] = $object;
		}
	}
	
	/**
	 * Return the current status of an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	string
	 */
	private function _getObjectStatus($oid, $object)
	{
		if(!isset($this->_objectsStatus[$oid]))
		{
			return self::_STATUS_CLEAN;
		}
		 
		return $this->_objectsStatus[$oid];
	}
	
	/**
	 * Return the previous status of an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	string
	 */
	private function _getPreviousObjectStatus($oid, $object)
	{
		if(!isset($this->_previousObjectsStatus[$oid]))
		{
			return self::_STATUS_CLEAN;
		}
		 
		return $this->_previousObjectsStatus[$oid];
	}
}
