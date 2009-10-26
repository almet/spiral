<?php

namespace Spiral\Framework\Persistence\ORM;

require_once('PHPUnit/Framework.php');

/**
 * Unit of work test
 *
 * This is a generic test for all UnitOfWork implementations
 *
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class UnitOfWorkTestAbstract extends \PHPUnit_Framework_TestCase
{
	/**
	 * Unit of work to test
	 */
	protected $_unitOfWork = null;
	
	/**
	 * Meta objects to manipulate
	 */
	protected $_object1 = null;
	protected $_object2 = null;
	
	/**
	 * Assert new objects commited
	 */
	abstract public function assertNewObjectsCommited();
	
	/**
	 * Assert dirty objects commited
	 */
	abstract public function assertDirtyObjectsCommited();
	
	/**
	 * Assert deleted objects commited
	 */
	abstract public function assertDeletedObjectsCommited();
	
	/**
	 * Assert the commit of delete after new
	 */
	abstract public function assertDeleteAfterNewCommited();
	
	/**
	 * Assert the commit of delete after dirty
	 */
	abstract public function assertDeleteAfterDirtyCommited();
	
	/**
	 * Assert the commit of dirty after new
	 */
	abstract public function assertDirtyAfterNewCommited();
	
	/**
	 * Test registration of new objects
	 */
	public function testNewObjects()
	{
		$this->_unitOfWork->registerNew(1, $this->_object1);
		$this->_unitOfWork->registerNew(2, $this->_object2);
		$this->_unitOfWork->commit();
		
		$this->assertNewObjectsCommited();
	}
	
	/**
	 * Test registration of dirty objects
	 */
	public function testDirtyObjects()
	{
		$this->_unitOfWork->registerDirty(1, $this->_object1);
		$this->_unitOfWork->registerDirty(2, $this->_object2);
		$this->_unitOfWork->commit();
		
		$this->assertDirtyObjectsCommited();
	}
	
	/**
	 * Test registration of deleted objects
	 */
	public function testDeletedObjects()
	{
		$this->_unitOfWork->registerDeleted(1);
		$this->_unitOfWork->registerDeleted(2);
		$this->_unitOfWork->commit();
		
		$this->assertDeletedObjectsCommited();
	}
	
	/**
	 * Test registration of a deleted object after it was set as new
	 */
	public function testDeleteAfterNew()
	{
		$this->_unitOfWork->registerNew(1, $this->_object1);
		$this->_unitOfWork->registerDeleted(1);
		$this->_unitOfWork->commit();
		
		$this->assertDeleteAfterNewCommited();
	}
	
	/**
	 * Test registration of a deleted object after it was set as dirty
	 */
	public function testDeleteAfterDirty()
	{
		$this->_unitOfWork->registerDirty(1, $this->_object1);
		$this->_unitOfWork->registerDeleted(1);
		$this->_unitOfWork->commit();
		
		$this->assertDeleteAfterDirtyCommited();
	}
	
	/**
	 * Test registration of a dirty object after it was set as new
	 */
	public function testDirtyAfterNew()
	{
		$this->_unitOfWork->registerNew(1, $this->_object1);
		$this->_unitOfWork->registerDirty(1, $this->_object1);
		$this->_unitOfWork->commit();
		
		$this->assertDirtyAfterNewCommited();
	}
	
	/**
	 * Test commit after rollback
	 */
	public function testCommitAfterRollback()
	{
		$this->_unitOfWork->registerNew(1, $this->_object1);
		$this->_unitOfWork->registerDirty(2, $this->_object2);
		$this->_unitOfWork->registerDeleted(3);
		
		$this->_unitOfWork->rollback();
		$this->_unitOfWork->commit();
		
		$this->assertCommitAfterRollback();
	}
}
