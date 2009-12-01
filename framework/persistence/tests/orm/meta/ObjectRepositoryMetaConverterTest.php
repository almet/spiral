<?php

namespace spiral\framework\persistence\orm\meta;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\fixtures\orm\meta\ExposedObjectRepositoryMetaConverter;
use \spiral\framework\persistence\fixtures\MockObjectRepository;

/**
 * Object repository meta converter test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ObjectRepositoryMetaConverterTest extends TestCase
{
	protected $_objectRepositoryMetaConverter = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_objectRepositoryMetaConverter = new ExposedObjectRepositoryMetaConverter();
		$this->_objectRepositoryMetaConverter->setObjectRepository(new MockObjectRepository());
	}
	
	/**
	 * Test converting instance to meta value and vis-versa
	 */
	public function testBothConversions()
	{
		$instance = new \stdClass();
		$metaValue = $this->_objectRepositoryMetaConverter->exposedConvertInstanceToMetaValue($instance);
		
		$this->assertEquals($metaValue, spl_object_hash($instance));
		
		$newInstance = $this->_objectRepositoryMetaConverter->exposedConvertMetaValueToInstance($metaValue);
		
		$this->assertEquals($newInstance, $instance);
	}
		
}
