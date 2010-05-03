<?php

namespace spiral\framework\persistence;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\orm\AbstractUnitOfWork;

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
	protected $_unitOfWork = null;
	protected $_identityMap = null;
	protected $_object1 = null;
	protected $_object2 = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_objectRepository = new ORMObjectRepository();
		
		$this->_oidGenerator = $this->getMock('\spiral\framework\persistence\orm\OIDGenerator');
		
		$this->_unitOfWork = $this->getMock('\spiral\framework\persistence\orm\UnitOfWork');
		
		$this->_identityMap = $this->getMock('\spiral\framework\persistence\orm\IdentityMap');
		
		$this->_objectRepository->setOIDGenerator($this->_oidGenerator);
		$this->_objectRepository->setUnitOfWork($this->_unitOfWork);
		$this->_objectRepository->setIdentityMap($this->_identityMap);
		
		$this->_object1 = new \stdClass();
		$this->_object2 = new \stdClass();
	}

	/**
	 * Test registration of new objects
	 */
	public function testNewObjects()
	{
		//TODO : Create the test
		/*$this->_storageEngine->expects($this->at(0))
			->method('add')
			->with($this->equalTo($this->_object1));
			
		$this->_storageEngine->expects($this->at(1))
			->method('add')
			->with($this->equalTo($this->_object2));
		
		$this->add($this->_object1);
		$this->add($this->_object2);*/
	}
	
}
