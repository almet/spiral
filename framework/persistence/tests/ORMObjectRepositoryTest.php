<?php

namespace spiral\framework\persistence;

use \spiral\framework\persistence\TestCase;

/**
 * ORM object repository test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ORMObjectRepositoryTest extends TestCase
{
	protected $_objectRepository = null;
	protected $_oidGenerator = null;
	protected $_storageEngine = null;
	protected $_unitOfWork = null;
	protected $_identityMap = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_objectRepository = new ORMObjectRepository();
		
		$this->_oidGenerator = $this->getMock('\spiral\framework\persistence\orm\OIDGenerator');
		
		$this->_storageEngine = $this->getMock('\spiral\framework\persistence\orm\backend\StorageEngine');
		
		$this->_unitOfWork = $this->getMock('\spiral\framework\persistence\orm\UnitOfWork');
		
		$this->_identityMap = $this->getMock('\spiral\framework\persistence\orm\IdentityMap');
		
		$this->_objectRepository->setOIDGenerator($this->_oidGenerator);
		$this->_objectRepository->setStorageEngine($this->_storageEngine);
		$this->_objectRepository->setUnitOfWork($this->_unitOfWork);
		$this->_objectRepository->setIdentityMap($this->_identityMap);
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
	
}
