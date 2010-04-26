<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Criterion;
use \spiral\framework\persistence\query\DefaultCriterion;

/**
 * Default criterion test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriterionTest extends TestCase
{
	protected $_criterion = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_criterion = new DefaultCriterion();
	}

	/**
	 * Test criteria operator definition
	 */
	public function testCriteriaOperatorDefinition()
	{
		$this->_criteria->setCriteriaOperator(Criteria::LOGICAL_AND);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(NULL, $operator);
		
		$this->_criteria->setCriteriaOperator(Criteria::LOGICAL_OR);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(NULL, $operator);
	}

	/**
	 * Test criteria array definition
	 */
	public function testCriteriaArrayDefinition()
	{
		$this->_criteria->setCriteriaArray(array());
		$criteriaArray = $this->_criteria->getCriteriaArray();
		
		$this->assertEquals(NULL, $criteriaArray);
	}

	/**
	 * Test criterion operator definition
	 */
	public function testCriterionOperatorDefinition()
	{
		$this->_criteria->setCriterionOperator(Criterion::EQUAL);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::EQUAL, $operator);
		
		$this->_criteria->setCriterionOperator(Criterion::GREATER_THAN);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::GREATER_THAN, $operator);
		
		$this->_criteria->setCriterionOperator(Criterion::GREATER_THAN_OR_EQUAL);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::GREATER_THAN_OR_EQUAL, $operator);
		
		$this->_criteria->setCriterionOperator(Criterion::LIKE);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::LIKE, $operator);
		
		$this->_criteria->setCriterionOperator(Criterion::LOWER_THAN);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::LOWER_THAN, $operator);
		
		$this->_criteria->setCriterionOperator(Criterion::LOWER_THAN_OR_EQUAL);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criterion::LOWER_THAN_OR_EQUAL, $operator);
	}
	
	/**
	 * Test criterion attribute definition
	 */
	public function testAttributeDefinition()
	{
		$expectedAttribute = 'test';
		
		$this->_criteria->setAttribute($expectedAttribute);
		$attribute = $this->_criteria->getAttribute();
		
		$this->assertEquals($expectedAttribute, $attribute);
	}
	
	/**
	 * Test criterion value definition
	 */
	public function testValueDefinition()
	{
		$expectedValue = 'test of Value';
		
		$this->_criteria->setCriteriaArray($expectedValue);
		$value = $this->_criteria->getCriteriaArray();
		
		$this->assertEquals($expectedValue, $value);
	}
}
