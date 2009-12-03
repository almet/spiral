<?php

namespace spiral\framework\persistence\orm;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\fixtures\orm\meta\MockMetaConverter;
use \spiral\framework\persistence\orm\StorageEngineUnitOfWork;

/**
 * Storage engine unit of work test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class StorageEngineUnitOfWorkTest extends TestCase
{
	protected $_unitOfWork = null;
	protected $_storageEngine = null;
	protected $_metaConverter = null;
	protected $_object1 = null;
	protected $_object2 = null;
	protected $_metaObject1 = null;
	protected $_metaObject2 = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_object1 = new \stdClass();
		$this->_object2 = new \stdClass();
		
		$this->_metaObject1 = $this->getMock('\spiral\framework\persistence\orm\meta\MetaObject');
		$this->_metaObject1->expects($this->any())->method('getClass')->will($this->returnValue('\stdClass'));
		$this->_metaObject1->expects($this->any())->method('getAttributes')->will($this->returnValue(array()));
		
		$this->_metaObject2 = $this->getMock('\spiral\framework\persistence\orm\meta\MetaObject');
		$this->_metaObject2->expects($this->any())->method('getClass')->will($this->returnValue('\stdClass'));
		$this->_metaObject2->expects($this->any())->method('getAttributes')->will($this->returnValue(array()));
		
		$this->_unitOfWork = new StorageEngineUnitOfWork();
		
		$this->_metaConverter = $this->getMock('\spiral\framework\persistence\orm\meta\MetaConverter');
		$this->_metaConverter->expects($this->any())
			->method('convertToMetaObject')
			->with($this->equalTo($this->_object1))
			->will($this->returnValue($this->_metaObject1));
		$this->_metaConverter->expects($this->any())
			->method('convertToMetaObject')
			->with($this->equalTo($this->_object2))
			->will($this->returnValue($this->_metaObject2));
		
		$this->_storageEngine = $this->getMock('\spiral\framework\persistence\orm\backend\StorageEngine');
		
		$this->_unitOfWork->setMetaConverter($this->_metaConverter);
		$this->_unitOfWork->setStorageEngine($this->_storageEngine);
	}

	/**
	 * Test commit new objects
	 */
	public function testCommitNew()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->add(2, $this->_object2);
		
		$this->_storageEngine->expects($this->at(0))
			->method('insert')
			->with($this->equalTo($this->_metaObject1));
			
		$this->_storageEngine->expects($this->at(1))
			->method('insert')
			->with($this->equalTo($this->_metaObject2));
		
		$this->_unitOfWork->commit();
	}
	
	/**
	 * Test commit dirty objects
	 */
	public function testCommitDirty()
	{
		$this->_unitOfWork->update(1, $this->_object1);
		$this->_unitOfWork->update(2, $this->_object2);
		
		$this->_storageEngine->expects($this->at(0))
			->method('update')
			->with($this->equalTo($this->_metaObject1));
			
		$this->_storageEngine->expects($this->at(1))
			->method('update')
			->with($this->equalTo($this->_metaObject2));
		
		$this->_unitOfWork->commit();
	}
	
	/**
	 * Test commit deleted objects
	 */
	public function testCommitDeleted()
	{
		$this->_unitOfWork->delete(1, $this->_object1);
		$this->_unitOfWork->delete(2, $this->_object2);
		
		$this->_storageEngine->expects($this->at(0))
			->method('delete')
			->with($this->equalTo($this->_metaObject1));
			
		$this->_storageEngine->expects($this->at(1))
			->method('delete')
			->with($this->equalTo($this->_metaObject2));
		
		$this->_unitOfWork->commit();
	}
	
	/**
	 * Test commit objects with different status
	 */
	public function testCommitMixedStatus()
	{
		$this->_unitOfWork->add(1, $this->_object1);
		$this->_unitOfWork->update(2, $this->_object2);
		$this->_unitOfWork->delete(3, $this->_object2);
		
		$this->_storageEngine->expects($this->once())
			->method('insert')
			->with($this->equalTo($this->_metaObject1));
			
		$this->_storageEngine->expects($this->once())
			->method('delete')
			->with($this->equalTo($this->_metaObject2));
		
		$this->_storageEngine->expects($this->once())
			->method('update')
			->with($this->equalTo($this->_metaObject2));
			
		$this->_unitOfWork->commit();
	}
	
}
