<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Query;
use \spiral\framework\persistence\query\DefaultQueryFactory;

/**
 * Default query factory test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultQueryFactoryTest extends TestCase
{
	protected $_queryFactory = NULL;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_queryFactory = new DefaultQueryFactory();
	}

	/**
	 * Test query creation
	 */
	public function testQueryCreation()
	{
		$query = $this->_queryFactory->createQuery();
		
		$this->assertType('\\spiral\\framework\\persistence\\query\\DefaultQuery', $query);
	}
}
