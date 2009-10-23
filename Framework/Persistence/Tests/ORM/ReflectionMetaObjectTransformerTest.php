<?php

namespace Spiral\Framework\Persistence\ORM;

use Spiral\Framework\Persistence\Fixtures;

/**
 * Reflection based meta object transformer test
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class ReflectionMetaObjectTransformerTest extends MetaObjectTransformerTest
{
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		parent::setUp();
		
		$this->_metaObjectTransformer = new ReflectionMetaObjectTransformer();
		$this->_metaObjectTransformer->setObjectRepository(new Fixtures\MockObjectRepository());

		$attributes = array('firstName'=>'James',
							'surName'=>'Brown',
							'nickname'=>'The godfather of soul',
							'birthdate'=>'1933-05-03',
							'discography'=>spl_object_hash($this->_object->discography));
		
		$this->_metaObject->setAttributes($attributes);
	}
}
