<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Abstract unit of work
 * 
 * This component manages objects status changes in collections
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class AbstractUnitOfWork implements UnitOfWork
{
	/**
	 * Deleted objects collection
	 */
	protected $_deletedObjects = array();
	
	/**
	 * Dirty objects collection
	 */
	protected $_dirtyObjects = array();
	
	/**
	 * New objects collection
	 */
	protected $_newObjects = array();
	
	/**
	 * Clean up object collections
	 * 
	 * @return	void
	 */
	protected function _cleanUp()
	{
		$this->_deletedObjects = array();
		$this->_dirtyObjects = array();
		$this->_newObjects = array();
	}
	
	/**
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	abstract protected function _commit();
	
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
	 * Define the status of an object as deleted
	 * 
	 * @param	mixed	$oid		Object ID
	 * 
	 * @return	void
	 */
	public function registerDeleted($oid)
	{
		if(isset($this->_newObjects[$oid]))
		{
			unset($this->_newObjects[$oid]);
		}
		elseif(isset($this->_dirtyObjects[$oid]))
		{
			unset($this->_dirtyObjects[$oid]);
		}
		elseif(array_search($oid, $this->_deletedObjects) === false)
		{
			$this->_deletedObjects[] = $oid;
		}
	}
	
	/**
	 * Define the status of an object as dirty
	 * 
	 * The object must not be registered as deleted.
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object which status has to be set
	 * 
	 * @return	void
	 */
	public function registerDirty($oid, $object)
	{
		if(isset($this->_newObjects[$oid]))
		{
			$this->_newObjects[$oid] = $object;
		}
		else
		{
			$this->_dirtyObjects[$oid] = $object;
		}
	}
	
	/**
	 * Define the status of an object as new
	 * 
	 * The object must not be registered in the unit of work.
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object which status has to be set
	 * 
	 * @return	void
	 */
	public function registerNew($oid, $object)
	{
		// Register object as new
		$this->_newObjects[$oid] = $object;
	}
}
