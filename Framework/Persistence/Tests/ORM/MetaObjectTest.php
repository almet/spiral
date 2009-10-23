<?php

namespace Spiral\Framework\Persistence\ORM;

require_once('PHPUnit/Framework.php');

/**
 * Meta object test
 * 
 * This is a generic test for all MetaObject implementations
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class MetaObjectTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Meta object to test
	 * 
	 * @var	MetaObject
	 */
	protected $_metaObject = null;
	
	/**
	 * Test if the class is correctly keeped
	 */
	public function testClass()
	{
		$classToSet = 'Test';
		
		$this->_metaObject->setClass($classToSet);
		$class = $this->_metaObject->getClass();
		
		$this->assertEquals($class, $classToSet);
	}
	
	/**
	 * Test if attributes are correctly keeped
	 */
	public function testAttributes()
	{
		$attributesToSet = array('attribute1'=>'hello world', 'attribute2'=>342);
		
		$this->_metaObject->setAttributes($attributesToSet);
		$attributes = $this->_metaObject->getAttributes();
		
		$this->assertEquals($attributes, $attributesToSet);
	}
}
