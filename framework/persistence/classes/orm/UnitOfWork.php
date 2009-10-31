<?php

namespace spiral\framework\persistence\orm;

/**
 * Unit of work
 * 
 * This component is a unit of work as defined by Martin Fowler at 
 * {@link http://martinfowler.com/eaaCatalog/unitOfWork.html}.
 * 
 * The role of this component is to manage the status of objects stored in the {@link ObjectRepository}.
 * The status of an object can take 4 values:
 * 	- new
 * 	- dirty
 * 	- deleted
 * 	- clean
 * 
 * Four operations can be done on objects that make status update:
 * 	- add
 * 	- update
 * 	- delete
 * 	- clean
 * 
 * Changes in status is up to the actual implementation of this interface.
 * 
 * The unit of work is responsible of recensing only the needed operations that have to be communicated 
 * to the {@link StorageEngine}.
 * 
 * For example, if an object is added then deleted from the {@link ObjectRepository}, no operation have 
 * to be sent to the {@link StorageEngine}.
 * 
 * Moreover, the unit of work acts as a transaction process since it is possible to rollback or to commit all 
 * the registered operations to the storage engine depending on contextual choice.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface UnitOfWork
{
	/**
	 * Commit all operations to the storage engine
	 * 
	 * @return	void
	 */
	public function commit();
	
	/**
	 * Rollback all operations
	 * 
	 * @return	void
	 */
	public function rollback();
	
	/**
	 * Add an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function add($oid, $object);
	
	/**
	 * Update an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function update($oid, $object);
	
	/**
	 * Delete an object
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function delete($oid, $object);
	
	/**
	 * Make an object clean
	 * 
	 * @param	mixed	$oid		Object ID
	 * @param	object	$object		Object
	 * @return	void
	 */
	public function clean($oid, $object);
}