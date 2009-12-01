<?php

namespace spiral\framework\persistence\orm\meta;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\fixtures\Album;
use \spiral\framework\persistence\fixtures\Artist;
use \spiral\framework\persistence\fixtures\Discography;
use \spiral\framework\persistence\fixtures\MockObjectRepository;
use \spiral\framework\persistence\orm\meta\DefaultMetaObject;

/**
 * Reflection meta converter test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ReflectionMetaConverterTest extends TestCase
{
	protected $_metaConverter = null;
	protected $_object = null;
	protected $_metaObject = null;
	protected $_oid = null;
	
	/**
	 * Compare 2 meta objects
	 */
	private function _assertMetaObjectsEquals($object1, $object2)
	{
		$this->assertType('\spiral\framework\persistence\orm\meta\MetaObject', $object1);
		$this->assertType('\spiral\framework\persistence\orm\meta\MetaObject', $object2);
		$this->assertEquals($object1->getAttributes(), $object2->getAttributes());
		$this->assertEquals($object1->getClass(), $object2->getClass());
	}
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_object = new Artist('James', 'Brown');
			$discography = new Discography();
			$discography->addAlbum(new Album('Please please please', 2004, 'cd'));
			$discography->addAlbum(new Album('Sex machine', 1970, 'vinyl'));
		$this->_object->setDiscography($discography);
		$this->_object->setBirthdate('1933-05-03');
		$this->_object->setNickname('The godfather of soul');
		
		$this->_oid = 334;
		
		$this->_metaObject = new DefaultMetaObject();
		$this->_metaObject->setClass('spiral\framework\persistence\fixtures\Artist');
		
		$this->_metaConverter = new ReflectionMetaConverter();
		$this->_metaConverter->setObjectRepository(new MockObjectRepository());

		$attributes = array('firstName'=>'James',
							'surName'=>'Brown',
							'nickname'=>'The godfather of soul',
							'birthdate'=>'1933-05-03',
							'discography'=>spl_object_hash($this->_object->discography),
							'oid'=>$this->_oid);
		
		$this->_metaObject->setAttributes($attributes);
	}
	
	/**
	 * Test that a complex object is correctly converted to a meta object and vis-versa
	 * 
	 * The object have multiple types (polymorphism) and have multiple relations to other objects.
	 */
	public function testBothTransformations()
	{
		$generatedMetaObject = $this->_metaConverter->convertToMetaObject($this->_object, $this->_oid);
		
		$this->_assertMetaObjectsEquals($generatedMetaObject, $this->_metaObject);
		
		$generatedObject = $this->_metaConverter->convertToInstance($generatedMetaObject);
		
		$this->assertEquals($this->_object, $generatedObject);
	}
}
