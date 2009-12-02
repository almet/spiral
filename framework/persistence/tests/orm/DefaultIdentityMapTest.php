<?php

namespace spiral\framework\persistence\orm;

use \spiral\framework\persistence\TestCase;

/**
 * Default identity map test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultIdentityMapTest extends TestCase
{
	protected $_identityMap = null;
	protected $_object = null;
	protected $_oid = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_identityMap = new DefaultIdentityMap();
		$this->_object = new \stdClass();
		$this->_oid = 345;
	}
	
	/**
	 * Test that the map contains an object after registration
	 */
	public function testContainsObjectAfterRegistration()
	{
		$test = $this->_identityMap->containsObject($this->_object);
		
		$this->assertFalse($test);
		
		$this->_identityMap->register($this->_oid, $this->_object);
		$test = $this->_identityMap->containsObject($this->_object);
		
		$this->assertTrue($test);
	}
	
	/**
	 * Test finding an object by OID
	 */
	public function testFindingObjectByOID()
	{
		$this->_identityMap->register($this->_oid, $this->_object);
		$object = $this->_identityMap->findObjectByOID($this->_oid);
		
		$this->assertEquals($object, $this->_object);
	}
	
	/**
	 * Test finding an OID from the instance
	 */
	public function testFindingOIDFromInstance()
	{
		$this->_identityMap->register($this->_oid, $this->_object);
		$oid = $this->_identityMap->findOIDByObject($this->_object);
		
		$this->assertEquals($oid, $this->_oid);
	}
	
}
