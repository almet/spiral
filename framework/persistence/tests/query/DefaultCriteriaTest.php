<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Criteria;
use \spiral\framework\persistence\query\DefaultCriteria;

/**
 * Default criteria test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriteriaTest extends TestCase
{
	protected $_criteria = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_criteria = new DefaultCriteria();
	}

	/**
	 * Test criteria operator definition
	 */
	public function testCriteriaOperatorDefinition()
	{
		$this->_criteria->setCriteriaOperator(Criteria::LOGICAL_AND);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criteria::LOGICAL_AND, $operator);
		
		$this->_criteria->setCriteriaOperator(Criteria::LOGICAL_OR);
		$operator = $this->_criteria->getCriteriaOperator();
		
		$this->assertEquals(Criteria::LOGICAL_OR, $operator);
	}

	/**
	 * Test criteria array definition
	 */
	public function testCriteriaArrayDefinition()
	{
		$criteria1 = new DefaultCriteria();
		$criteria2 = new DefaultCriterion();
		$criteria3 = new DefaultCriteria();
		$criteria4 = new DefaultCriteria();
		$criteria5 = new DefaultCriterion();
		
		$expectedCriteriaArray = array($criteria1, $criteria2, $criteria3, $criteria4, $criteria5);
		
		$this->_criteria->setCriteriaArray($expectedCriteriaArray);
		$criteriaArray = $this->_criteria->getCriteriaArray();
		
		$this->assertEquals($expectedCriteriaArray, $criteriaArray);
	}
}
