<?php

namespace spiral\framework\persistence\orm\meta;

use \spiral\framework\persistence\TestCase;

/**
 * Default meta object test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultMetaObjectTest extends TestCase
{
	protected $_metaObject = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_metaObject = new DefaultMetaObject();
	}
	
	/**
	 * Test if the class is correctly kept
	 */
	public function testClass()
	{
		$classToSet = '\full\class\name\Test';
		
		$this->_metaObject->setClass($classToSet);
		$class = $this->_metaObject->getClass();
		
		$this->assertEquals($class, $classToSet);
	}
	
	/**
	 * Test if attributes are correctly kept
	 */
	public function testAttributes()
	{
		$attributesToSet = array('attribute1'=>'hello world', 'attribute2'=>342);
		
		$this->_metaObject->setAttributes($attributesToSet);
		$attributes = $this->_metaObject->getAttributes();
		
		$this->assertEquals($attributes, $attributesToSet);
	}
}
