<?php

namespace spiral\framework\persistence\orm;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\fixtures\orm\ExposedAbstractUnitOfWork;
use \spiral\framework\persistence\orm\AbstractUnitOfWork;

/**
 * Abstract unit of work test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class AbstractUnitOfWorkTest extends TestCase
{
	protected $_unitOfWork = null;
	protected $_object1 = null;
	protected $_object2 = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_unitOfWork = new ExposedAbstractUnitOfWork();
		$this->_object1 = new \stdClass();
		$this->_object2 = new \stdClass();
	}

	/**
	 * Test registration of new objects
	 */
	public function testNewObjects()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->add(2, $this->_object2);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_NEW,
								2=>AbstractUnitOfWork::_STATUS_NEW);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of dirty objects
	 */
	public function testDirtyObjects()
	{
		$this->_unitOfWork->update(1, $this->_object1);
		$this->_unitOfWork->update(2, $this->_object2);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_DIRTY,
								2=>AbstractUnitOfWork::_STATUS_DIRTY);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of deleted objects
	 */
	public function testDeletedObjects()
	{
		$this->_unitOfWork->delete(1, $this->_object1);
		$this->_unitOfWork->delete(2, $this->_object2);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_DELETED,
								2=>AbstractUnitOfWork::_STATUS_DELETED);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of clean objects
	 */
	public function testCleanObjects()
	{
		$this->_unitOfWork->clean(1, $this->_object1);
		
		$this->_unitOfWork->add(2, $this->_object2);
		$this->_unitOfWork->clean(2, $this->_object2);
		
		$this->_unitOfWork->delete(3, $this->_object2);
		$this->_unitOfWork->clean(3, $this->_object2);
		
		$this->_unitOfWork->update(4, $this->_object2);
		$this->_unitOfWork->clean(4, $this->_object2);
		
		$expectedStatus = array();
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of a new object after it was set to deleted
	 */
	public function testNewAfterDelete()
	{
		$this->_unitOfWork->delete(1, $this->_object1);
		$this->_unitOfWork->add(1, $this->_object1);
		
		$expectedStatus = array();

		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
		
		$this->_unitOfWork->clean(1, $this->_object1);
		$this->_unitOfWork->update(1, $this->_object1);
		$this->_unitOfWork->delete(1, $this->_object1);
		$this->_unitOfWork->add(1, $this->_object1);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_DIRTY);

		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of a deleted object after it was set as new
	 */
	public function testDeleteAfterNew()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->delete(1, $this->_object1);
		
		$expectedStatus = array();
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of a deleted object after it was set as dirty
	 */
	public function testDeleteAfterDirty()
	{
		$this->_unitOfWork->update(1, $this->_object1);
		$this->_unitOfWork->delete(1, $this->_object1);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_DELETED);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of a dirty object after it was set as new
	 */
	public function testDirtyAfterNew()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->update(1, $this->_object1);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_NEW);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test registration of a dirty object after it was set to deleted
	 */
	public function testDirtyAfterDelete()
	{
		$this->_unitOfWork->delete(1, $this->_object1);
		$this->_unitOfWork->update(1, $this->_object1);
		
		$expectedStatus = array(1=>AbstractUnitOfWork::_STATUS_DELETED);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		
		$this->assertEquals($expectedStatus, $status);
	}
	
	/**
	 * Test commit
	 */
	public function testCommit()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->add(2, $this->_object2);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		$this->assertEquals(sizeof($status), 2);
		
		$objects = $this->_unitOfWork->exposedObjects();
		$this->assertEquals(sizeof($objects), 2);
		
		ob_start();
		$this->_unitOfWork->commit();
		$output = ob_get_clean();
		$this->assertEquals($output, 'committed');
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		$this->assertEquals($status, array());
		
		$objects = $this->_unitOfWork->exposedObjects();
		$this->assertEquals($objects, array());
	}
	
	/**
	 * Test rollback
	 */
	public function testRollback()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->add(2, $this->_object2);
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		$this->assertEquals(sizeof($status), 2);
		
		$objects = $this->_unitOfWork->exposedObjects();
		$this->assertEquals(sizeof($objects), 2);
		
		ob_start();
		$this->_unitOfWork->rollback();
		$output = ob_get_clean();
		$this->assertEquals($output, '');
		
		$status = $this->_unitOfWork->exposedObjectsStatus();
		$this->assertEquals($status, array());
		
		$objects = $this->_unitOfWork->exposedObjects();
		$this->assertEquals($objects, array());
	}
}
