<?php

namespace spiral\framework\persistence\query;

/**
 * Default implementation of a Query
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultQuery implements Query
{
	/**
	 * Class of objects targeted
	 * 
	 * Must contain the full name of the class including namespaces
	 * 
	 * @var	string
	 */
	private $_class = NULL;
	
	/**
	 * Offset
	 * 
	 * @var	int
	 */
	private $_offset = 0;
	
	/**
	 * Limit
	 * 
	 * @var	int
	 */
	private $_limit = NULL;
	
	/**
	 * Order
	 * 
	 * @var	array
	 */
	private $_order = array();
	
	/**
	 * Criteria
	 * 
	 * @var	Criteria
	 */
	private $_criteria = NULL;
	
	/**
	 * Criteria factory
	 * 
	 * @var	CriteriaFactory
	 */
	private $_criteriaFactory = NULL;
	
	/**
	 * Criterion factory
	 * 
	 * @var	CriterionFactory
	 */
	private $_criterionFactory = NULL;
	
	/**
	 * Define the class of objects that are targeted by the query
	 * 
	 * @param	string	$class	Class of queried objects
	 * 
	 * @return	void
	 */
	public function setClass($class)
	{
		$this->_class = $class;
	}
	
	/**
	 * Return the class of objects that are targeted by the query
	 * 
	 * @return	string	Class of queried objects
	 */
	public function getClass()
	{
		return $this->_class;
	}
	
	/**
	 * Define the range of the results
	 * 
	 * This method is a shortcut to define both the offset and the limit of results in one time.
	 * 
	 * @see		Query::setOffset()
	 * @see		Query::setLimit()
	 * 
	 * @param	int		$offset		First result index
	 * @param	int		$limit		Maximum number of results
	 * 
	 * @return	void
	 */
	public function setRange($offset, $limit)
	{
		$this->setOffset($offset);
		$this->setLimit($limit);
	}
	
	/**
	 * Define the first result index value (offset)
	 * 
	 * Define the first index from which results will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if first result is 7, only the 3 last objects 
	 * will be returned.
	 * 
	 * The default value is 0.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setLimit()
	 * 
	 * @param	int		$offset		First result index
	 * 
	 * @return	void
	 */
	public function setOffset($offset)
	{
		$this->_offset = $offset;
	}
	
	/**
	 * Return the first result index value (offset)
	 * 
	 * Return the first index from which results will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if first result is 7, only the 3 last objects 
	 * will be returned.
	 * 
	 * The default value is 0.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setLimit()
	 * 
	 * @return	int		First result index
	 */
	public function getOffset()
	{
		return $this->_offset;
	}
	
	/**
	 * Define the maximum number of results that will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if limit is 7, only the 7 first 
	 * objects will be returned.
	 * 
	 * If the limit value is greater than the number of results, all the results will be returned.
	 * 
	 * If null, all results will be returned.
	 * 
	 * The default value is null.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setOffset()
	 * 
	 * @param	int		$limit		Maximum number of results
	 * 
	 * @return	void
	 */
	public function setLimit($limit)
	{
		$this->_limit = $limit;
	}
	
	/**
	 * Return the maximum number of results that will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if limit is 7, only the 7 first 
	 * objects will be returned.
	 * 
	 * If the limit value is greater than the number of results, all the results will be returned.
	 * 
	 * If null, all results will be returned.
	 * 
	 * The default value is null.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setOffset()
	 * 
	 * @param	int		Maximum number of results
	 */
	public function getLimit()
	{
		return $this->_limit;
	}
	
	/**
	 * Set the rules for sorting objects
	 * 
	 * An array of the attributes associated to their ordering value.
	 * 
	 * Keys of the array are attribute names and values are order mode (Query::ASCENDING or Query::DESCENDING)
	 * 
	 * Example :
	 * <code>
	 * $order = array('name'=>Query::ASCENDING, 'age'=>Query::DESCENDING);
	 * 
	 * $query->setOrder($order);
	 * // Will sort objects by name from A to Z, then by age from the older to the younger
	 * </code>
	 * 
	 * @param	array		$order		Array of parameters with ordering mode
	 * 
	 * @return	void
	 */
	public function setOrder(array $order)
	{
		$this->_order = $order;
	}
	
	/**
	 * Return the rules for sorting objects
	 * 
	 * An array of the attributes associated to their ordering value.
	 * 
	 * Keys of the array are attribute names and values are order mode (Query::ASCENDING or Query::DESCENDING)
	 * 
	 * Example :
	 * <code>
	 * $order = array('name'=>Query::ASCENDING, 'age'=>Query::DESCENDING);
	 * 
	 * $query->setOrder($order);
	 * // Will sort objects by name from A to Z, then by age from the older to the younger
	 * </code>
	 * 
	 * @return	array		Array of parameters with ordering mode
	 */
	public function getOrder()
	{
		return $this->_order;
	}
	
	/**
	 * Define criteria that will be respected to filter results
	 * 
	 * Example of use:
	 * <code>
	 *	$criteria = $query->logicalAnd( $query->equals('firstName', 'James'),
	 *									$query->logicalOr( $query->greaterThan('age', 20),
	 *														$query->lowerThan('age', 50) ) );
	 *	
	 *	$query->match( $criteria );
	 * </code>
	 * 
	 * More information on criteria definition should be given in the {@link Criteria} documentation.
	 * 
	 * You could notice that since {@link Criterion} extends {@link Criteria}, a simple {@link Criterion}
	 * can be used instead of {@link Criteria}.
	 * 
	 * @see		Criteria
	 * @see		Criterion
	 * 
	 * @param	Criteria	$criteria		Criteria that the query must match
	 * 
	 * @return	void
	 */
	public function match(Criteria $criteria)
	{
		$this->_criteria = $criteria;
	}
	
	/**
	 * Return criteria that will be respected to filter results
	 * 
	 * Example of use:
	 * <code>
	 *	$criteria = $query->logicalAnd( $query->equals('firstName', 'James'),
	 *									$query->logicalOr( $query->greaterThan('age', 20),
	 *														$query->lowerThan('age', 50) ) );
	 *	
	 *	$query->match( $criteria );
	 * </code>
	 * 
	 * More information on criteria definition should be given in the {@link Criteria} documentation.
	 * 
	 * You could notice that since {@link Criterion} extends {@link Criteria}, a simple {@link Criterion}
	 * can be used instead of {@link Criteria}.
	 * 
	 * @see		Criteria
	 * @see		Criterion
	 * 
	 * @return	Criteria	Criteria that the query must match
	 */
	public function getCriteria()
	{
		return $this->_criteria;
	}
	
	/**
	 * Create a criterion of equality
	 * 
	 * Define that an attribute must be equal to a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->equals('name', 'James Brown') );
	 * // Will find all artists whose name are James Brown
	 * </code>
	 * 
	 * Attributes can be chained like this :
	 * <code>
	 * $query->setClass('Album');
	 * $query->match( $query->equals('artist->name', 'James Brown') );
	 * // Will find all albums from the artist named James Brown
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	An equality criterion
	 */
	public function equals($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::EQUAL, $attribute, $value);
	}
	
	/**
	 * Create a "like" criterion
	 * 
	 * Define that an attribute must be like a certain value.
	 * You can use the character % to replace whatever string.
	 * The character ? is used to replace any single character.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->equals('name', 'James %') );
	 * // Will find all artists whose name starts with James
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "like" criterion
	 */
	public function like($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::LIKE, $attribute, $value);
	}
	
	/**
	 * Create a "lower than" criterion
	 * 
	 * Define that an attribute must be strictly lower than a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->lowerThan('age', 50) );
	 * // Will find all artists that are strictly younger than 50
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "lower than" criterion
	 */
	public function lowerThan($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::LOWER_THAN, $attribute, $value);
	}
	
	/**
	 * Create a "lower than or equal" criterion
	 * 
	 * Define that an attribute must be lower than or equals a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->lowerThanOrEqual('age', 50) );
	 * // Will find all artists aged of 50 or younger
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "lower than or equal" criterion
	 */
	public function lowerThanOrEqual($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::LOWER_THAN_OR_EQUAL, $attribute, $value);
	}
	
	/**
	 * Create a "greater than" criterion
	 * 
	 * Define that an attribute must be strictly greater than a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->greaterThan('age', 50) );
	 * // Will find all the artists strictly older than 50
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "greater than" criterion
	 */
	public function greaterThan($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::GREATER_THAN, $attribute, $value);
	}
	
	/**
	 * Create a "greater than or equal" criterion
	 * 
	 * Define that an attribute must be greater than or equals a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->greaterThanOrEqual('age', 50) );
	 * // Will find all the artists aged of 50 or older
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "greater than or equal" criterion
	 */
	public function greaterThanOrEqual($attribute, $value)
	{
		$this->_criterionFactory->createCriterion(Criterion::GREATER_THAN_OR_EQUAL, $attribute, $value);
	}
	
	/**
	 * Group criteria with OR logic
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->logicalOr( $query->greaterThan('age', 50),
	 * 										$query->lowerThan('age', 20) ) );
	 * // Will find all the artists older than 50 or younger than 20
	 * </code>
	 * 
	 * @see		Criteria
	 * @see		Criterion
	 * 
	 * @param	Criteria	...		Criteria instances to group in an OR logic
	 * 
	 * @return	Criteria	Criteria grouping other criteria with an OR logic
	 */
	public function logicalOr()
	{
		$this->_criteriaFactory->createCriteria(Criteria::LOGICAL_OR, func_get_args());
	}
	
	/**
	 * Group criteria with AND logic
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->match( $query->logicalAnd( $query->greaterThan('age', 20),
	 * 										$query->lowerThan('age', 50) ) );
	 * // Will find all the artists whose age is between 20 and 50
	 * </code>
	 * 
	 * @see		Criteria
	 * @see		Criterion
	 * 
	 * @param	Criteria	...		Criteria instances to group in an AND logic
	 * 
	 * @return	Criteria	Criteria grouping other criteria with an AND logic
	 */
	public function logicalAnd()
	{
		$this->_criteriaFactory->createCriteria(Criteria::LOGICAL_AND, func_get_args());
	}
	
	/**
	 * Define the criteria factory to use to create criteria
	 * 
	 * @param	CriteriaFactory		$criteriaFactory		Criteria factory
	 * 
	 * @return	void
	 */
	public function setCriteriaFactory(CriteriaFactory $criteriaFactory)
	{
		$this->_criteriaFactory = $criteriaFactory;
	}
	
	/**
	 * Define the criterion factory to use to create a criterion
	 * 
	 * @param	CriterionFactory		$criterionFactory		Criterion factory
	 * 
	 * @return	void
	 */
	public function setCriterionFactory(CriterionFactory $criterionFactory)
	{
		$this->_criterionFactory = $criterionFactory;
	}
}