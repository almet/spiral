<?php

namespace spiral\framework\persistence\query;

use \spiral\framework\persistence\TestCase;
use \spiral\framework\persistence\query\Query;
use \spiral\framework\persistence\query\DefaultQuery;

/**
 * Default query test
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultQueryTest extends TestCase
{
	protected $_query = null;
	
	/**
	 * Sets up the testing environment
	 */
	public function setUp()
	{
		$this->_query = new DefaultQuery();
	}

	/**
	 * Test class definition
	 */
	public function testClassDefinition()
	{
		$expectedClass = '\\namespace\\to\\ClassName';
		$this->_query->setClass($expectedClass);
		$class = $this->_query->getClass();
		
		$this->assertEquals($expectedClass, $class);
	}

	/**
	 * Test offset definition
	 */
	public function testOffsetDefinition()
	{
		$expectedOffset = 30;
		$this->_query->setOffset($expectedOffset);
		$offset = $this->_query->getOffset();
		
		$this->assertEquals($expectedOffset, $offset);
	}

	/**
	 * Test limit definition
	 */
	public function testLimitDefinition()
	{
		$expectedLimit = 300;
		$this->_query->setLimit($expectedLimit);
		$limit = $this->_query->getLimit();
		
		$this->assertEquals($expectedLimit, $limit);
	}

	/**
	 * Test range definition
	 */
	public function testRangeDefinition()
	{
		$expectedOffset = 30;
		$expectedLimit = 400;
		$this->_query->setRange($expectedOffset, $expectedLimit);
		
		$offset = $this->_query->getOffset();
		$limit = $this->_query->getLimit();
		
		$this->assertEquals($expectedOffset, $offset);
		$this->assertEquals($expectedLimit, $limit);
	}
	
	/**
	 * Test order definition
	 */
	public function testOrderDefinition()
	{
		$expectedOrder = array('test'=>Query::ASCENDING, 'other->test'=>Query::DESCENDING);
		
		$this->_query->setOrder($expectedOrder);
		$order = $this->_query->getOrder();
		
		$this->assertEquals($expectedOrder, $order);
	}
	
	/**
	 * Test criteria definition
	 */
	public function testCriteriaDefinition()
	{
		$expectedCriteria = new DefaultCriteria();
		
		$this->_query->match($expectedCriteria);
		$criteria = $this->_query->getCriteria();
		
		$this->assertEquals($expectedCriteria, $criteria);
	}
	
	/**
	 * Test "equal" criterion creation
	 */
	public function testEqualsCreation()
	{
		$operator = Criterion::EQUAL;
		$attribute = 'test';
		$value = 'value';
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->equals($attribute, $value);
	}
	
	/**
	 * Test "greater than" criterion creation
	 */
	public function testGreaterThanCreation()
	{
		$operator = Criterion::GREATER_THAN;
		$attribute = 'test';
		$value = 340;
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->greaterThan($attribute, $value);
	}
	
	/**
	 * Test "greater than or equal" criterion creation
	 */
	public function testGreaterThanOrEqualCreation()
	{
		$operator = Criterion::GREATER_THAN_OR_EQUAL;
		$attribute = 'test';
		$value = 340;
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->greaterThanOrEqual($attribute, $value);
	}
	
	/**
	 * Test "lower than" criterion creation
	 */
	public function testLowerThanCreation()
	{
		$operator = Criterion::LOWER_THAN;
		$attribute = 'test';
		$value = 340;
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->lowerThan($attribute, $value);
	}
	
	/**
	 * Test "lower than or equal" criterion creation
	 */
	public function testLowerThanOrEqualCreation()
	{
		$operator = Criterion::LOWER_THAN_OR_EQUAL;
		$attribute = 'test';
		$value = 340;
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->lowerThanOrEqual($attribute, $value);
	}
	
	/**
	 * Test "like" criterion creation
	 */
	public function testLikeCreation()
	{
		$operator = Criterion::LIKE;
		$attribute = 'test';
		$value = 'test % of ?hrase';
		
		$criterionFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriterionFactory');
		$criterionFactory->expects($this->once())
						->method('createCriterion')
						->with($this->equalTo($operator),
								$this->equalTo($attribute),
								$this->equalTo($value));
		
		$this->_query->setCriterionFactory($criterionFactory);
		
		$this->_query->like($attribute, $value);
	}
	
	/**
	 * Test logical AND criteria creation
	 */
	public function testAndCriteriaCreation()
	{
		$operator = Criteria::LOGICAL_AND;
		$criteriaArray = array(new DefaultCriterion(), new DefaultCriterion());
		
		$criteriaFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriteriaFactory');
		$criteriaFactory->expects($this->once())
						->method('createCriteria')
						->with($this->equalTo($operator),
								$this->equalTo($criteriaArray));
		
		$this->_query->setCriteriaFactory($criteriaFactory);
								
		$this->_query->logicalAnd($criteriaArray);
	}
	
	/**
	 * Test logical OR criteria creation
	 */
	public function testOrCriteriaCreation()
	{
		$operator = Criteria::LOGICAL_OR;
		$criteriaArray = array(new DefaultCriterion(), new DefaultCriterion());
		
		$criteriaFactory = $this->getMock('\\spiral\\framework\\persistence\\query\\CriteriaFactory');
		$criteriaFactory->expects($this->once())
						->method('createCriteria')
						->with($this->equalTo($operator),
								$this->equalTo($criteriaArray));
		
		$this->_query->setCriteriaFactory($criteriaFactory);
		
		$this->_query->logicalOr($criteriaArray);
	}
}
