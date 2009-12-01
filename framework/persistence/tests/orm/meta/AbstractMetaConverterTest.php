<?php

namespace spiral\framework\persistence\orm\meta;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\fixtures\orm\meta\ExposedAbstractMetaConverter;

/**
 * Abstract meta converter test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class AbstractMetaConverterTest extends TestCase
{
	protected $_abstractMetaConverter = null;
	protected $_class = null;
	protected $_attributes = array();
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_abstractMetaConverter = new ExposedAbstractMetaConverter();
		$this->_class = 'spiral\framework\persistence\fixtures\Artist';
		$this->_attributes = array('firstName'=>'James', 'surName'=>'Brown', 'birthdate'=>'1933-04-03');
	}
	
	/**
	 * Test the creation of a meta object from an instance
	 */
	public function testCreatingAMetaObject()
	{
		$metaObject = $this->_abstractMetaConverter->exposedCreateMetaObject($this->_class, $this->_attributes);
		
		$this->assertType('spiral\framework\persistence\orm\meta\MetaObject', $metaObject);
		$this->assertEquals($metaObject->getClass(), $this->_class);
		$this->assertEquals($metaObject->getAttributes(), $this->_attributes);
	}
		
	/**
	 * Test the creation of an instance from a meta object
	 */
	public function testCreatingAnInstance()
	{
		$instance = $this->_abstractMetaConverter->exposedCreateInstance($this->_class, $this->_attributes);
		
		$class = get_class($instance);
		$attributes = get_object_vars($instance);
		$attributes['birthdate'] = $instance->getBirthdate();
		
		$expectedAttributes = array_merge(get_class_vars($this->_class), $this->_attributes);
		
		$this->assertType($this->_class, $instance);
		$this->assertEquals($class, $this->_class);
		$this->assertEquals($attributes, $expectedAttributes);
	}
		
}
