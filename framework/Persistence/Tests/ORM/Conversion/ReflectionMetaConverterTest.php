<?php

namespace Spiral\Framework\Persistence\ORM\Conversion;

use Spiral\Framework\Persistence\Fixtures\MockObjectRepository;

/**
 * Reflection based meta object converter test
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class ReflectionMetaConverterTest extends MetaConverterTestAbstract
{
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		parent::setUp();
		
		$this->_metaConverter = new ReflectionMetaConverter();
		$this->_metaConverter->setObjectRepository(new MockObjectRepository());

		$attributes = array('firstName'=>'James',
							'surName'=>'Brown',
							'nickname'=>'The godfather of soul',
							'birthdate'=>'1933-05-03',
							'discography'=>spl_object_hash($this->_object->discography));
		
		$this->_metaObject->setAttributes($attributes);
	}
}
