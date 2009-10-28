<?php

namespace Spiral\Framework\Persistence\ORM;

use \Spiral\Framework\Persistence\Fixtures\ORM\Backend\MockStorageEngine;
use \Spiral\Framework\Persistence\ORM\DefaultMetaObject;

/**
 * Storage engine unit of work test
 *
 * This is a generic test for all UnitOfWork implementations
 *
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class StorageEngineUnitOfWorkTest extends UnitOfWorkTestAbstract
{
	/**
	 * Storage engine
	 */
	protected $_storageEngine = null;
	
	/**
	 * Sets up the test environment
	 */
	public function setUp()
	{
		$this->_unitOfWork = new StorageEngineUnitOfWork();
		$this->_storageEngine = new MockStorageEngine();
		$this->_unitOfWork->setStorageEngine($this->_storageEngine);
		
		$this->_object1 = new DefaultMetaObject();
		$this->_object2 = new DefaultMetaObject();
	}
	
	/**
	 * Assert new objects commited
	 */
	public function assertNewObjectsCommited()
	{
		$waitEvents[] = array('INSERT', 1, $this->_object1);
		$waitEvents[] = array('INSERT', 2, $this->_object2);
		
		$this->assertEquals($this->_storageEngine->events, $waitEvents);
	}
	
	/**
	 * Assert dirty objects commited
	 */
	public function assertDirtyObjectsCommited()
	{
		$waitEvents[] = array('UPDATE', 1, $this->_object1);
		$waitEvents[] = array('UPDATE', 2, $this->_object2);
		
		$this->assertEquals($this->_storageEngine->events, $waitEvents);
	}
	
	/**
	 * Assert deleted objects commited
	 */
	public function assertDeletedObjectsCommited()
	{
		$waitEvents[] = array('DELETE', 1, null);
		$waitEvents[] = array('DELETE', 2, null);
		
		$this->assertEquals($this->_storageEngine->events, $waitEvents);
	}
	
	/**
	 * Assert the commit of delete after new
	 */
	public function assertDeleteAfterNewCommited()
	{
		$this->assertEquals($this->_storageEngine->events, array());
	}
	
	/**
	 * Assert the commit of delete after dirty
	 */
	public function assertDeleteAfterDirtyCommited()
	{
		$this->assertEquals($this->_storageEngine->events, array());
	}
	
	/**
	 * Assert the commit of dirty after new
	 */
	public function assertDirtyAfterNewCommited()
	{
		$waitEvents[] = array('INSERT', 1, $this->_object1);
		
		$this->assertEquals($this->_storageEngine->events, $waitEvents);
	}
	
	/**
	 * Assert the commit after a rollback
	 */
	public function assertCommitAfterRollback()
	{
		$this->assertEquals($this->_storageEngine->events, array());
	}
}
