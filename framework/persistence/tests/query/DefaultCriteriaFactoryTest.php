<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Criteria;
use \spiral\framework\persistence\query\DefaultCriteriaFactory;

/**
 * Default criteria factory test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriteriaFactoryTest extends TestCase
{
	protected $_criteriaFactory = NULL;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_criteriaFactory = new DefaultCriteriaFactory();
	}

	/**
	 * Test criteria creation
	 */
	public function testCriteriaCreation()
	{
		$expectedOperator = Criteria::LOGICAL_OR;
		$expectedCriteriaArray = array(new DefaultCriterion(), new DefaultCriterion());
		
		$criteria = $this->_criteriaFactory->createCriteria($expectedOperator, $expectedCriteriaArray);
		
		$this->assertType('\\spiral\\framework\\persistence\\query\\DefaultCriteria', $criteria);
		
		$operator = $criteria->getCriteriaOperator();
		$criteriaArray = $criteria->getCriteriaArray();
		
		$this->assertEquals($expectedOperator, $operator);
		$this->assertEquals($expectedCriteriaArray, $criteriaArray);
	}
}
