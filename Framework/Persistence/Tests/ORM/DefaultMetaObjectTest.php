<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Default meta object test
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class DefaultMetaObjectTest extends MetaObjectTest
{
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_metaObject = new DefaultMetaObject();
	}
}
