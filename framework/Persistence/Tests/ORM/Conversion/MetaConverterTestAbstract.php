<?php

namespace Spiral\Framework\Persistence\ORM\Conversion;

require_once('PHPUnit/Framework.php');
use Spiral\Framework\Persistence\Fixtures\Album;
use Spiral\Framework\Persistence\Fixtures\Artist;
use Spiral\Framework\Persistence\Fixtures\Discography;
use Spiral\Framework\Persistence\ORM\DefaultMetaObject;

/**
 * Meta object converter test
 * 
 * Generic test for all MetaConverter implementations.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class MetaConverterTestAbstract extends \PHPUnit_Framework_TestCase
{
	/**
	 * Meta object converter
	 */
	protected $_metaConverter;
	
	/**
	 * Complex native object fixture
	 */
	protected $_object;
	
	/**
	 * Complex meta object fixture
	 */
	protected $_metaObject;
	
	/**
	 * Compare 2 meta objects
	 */
	private function _assertMetaObjectsEquals($object1, $object2)
	{
		$this->assertType('\\Spiral\\Framework\\Persistence\\ORM\\MetaObject', $object1);
		$this->assertType('\\Spiral\\Framework\\Persistence\\ORM\\MetaObject', $object2);
		$this->assertEquals($object1->getAttributes(), $object2->getAttributes());
		$this->assertEquals($object1->getClass(), $object2->getClass());
	}
	
	/**
	 * Sets up the test environment
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
		
		$this->_metaObject = new DefaultMetaObject();
		$this->_metaObject->setClass('Spiral\\Framework\\Persistence\\Fixtures\\Artist');
	}
	
	/**
	 * Test that a complex object is correctly converted to a meta object and vis-versa
	 * 
	 * The object have multiple types (polymorphism) and have multiple relations to other objects.
	 */
	public function testBothTransformations()
	{
		$generatedMetaObject = $this->_metaConverter->convertToMetaObject($this->_object);
		
		$this->_assertMetaObjectsEquals($generatedMetaObject, $this->_metaObject);
		
		$generatedObject = $this->_metaConverter->convertToInstance($generatedMetaObject);
		
		$this->assertEquals($this->_object, $generatedObject);
	}
}
