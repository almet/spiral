<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Criterion;
use \spiral\framework\persistence\query\DefaultCriterionFactory;

/**
 * Default criterion factory test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriterionFactoryTest extends TestCase
{
	protected $_criterionFactory = NULL;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_criterionFactory = new DefaultCriterionFactory();
	}

	/**
	 * Test criterion creation
	 */
	public function testCriterionCreation()
	{
		$expectedOperator = Criterion::LIKE;
		$expectedAttribute = 'test';
		$expectedValue = 453;
		
		$criterion = $this->_criterionFactory->createCriterion($expectedOperator, $expectedAttribute, $expectedValue);
		
		$this->assertType('\\spiral\\framework\\persistence\\query\\DefaultCriterion', $criterion);
		
		$operator = $criterion->getCriterionOperator();
		$attribute = $criterion->getAttribute();
		$value = $criterion->getValue();
		
		$this->assertEqual($expectedOperator, $operator);
		$this->assertEqual($expectedAttribute, $attribute);
		$this->assertEqual($expectedValue, $value);
	}
}
