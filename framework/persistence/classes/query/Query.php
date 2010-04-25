<?php

namespace spiral\framework\persistence\query;

/**
 * Query
 * 
 * A query is the way to find objects by criteria in a repository.
 * 
 * There are different solutions to create a new query :
 * 
 * - Use the {@link ObjectRepository::createQuery()} method.
 * - Use a special factory that will help the creation (for example, you can imagine creating a query 
 * 		from SQL-like string or from XPath syntax or LinQ or whatever)
 * - Direct creation is not advisable because of inversion of control
 * 
 * Example of use :
 * <code> 
 *	$query = $repository->createQuery('\\namespace\\to\\Artist');
 *	
 *	$criteria = $query->logicalAnd( $query->equals('firstName', 'James'),
 *									$query->logicalOr( $query->greaterThan('age', 20),
 *														$query->lowerThan('age', 50) ) );
 *	
 *	$query->match( $criteria );
 *
 *	$query->setRange(0, 25);
 *	
 *	$query->setOrder(array('name'=>Query::ASCENDING, 'age'=>Query::DESCENDING));
 *
 *	$objects = $repository->findByQuery( $query );	
 * </code>
 * 
 * @see			ObjectRepository::findByQuery()
 * @see			ObjectRepository::createQuery()
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Query
{
	/**
	 * Ascending order
	 * 
	 * @var	int
	 */
	const ASCENDING = 1;
	
	/**
	 * Descending order
	 * 
	 * @var	int
	 */
	const DESCENDING = 2;
	
	/**
	 * Define the class of objects that are targeted by the query
	 * 
	 * @param	string	$class	Class of queried objects
	 */
	public function setClass($class);
	
	/**
	 * Define the range of the results
	 * 
	 * This method is a shortcut to define both the offset and the limit of results in one time.
	 * 
	 * @see		Query::setOffset()
	 * @see		Query::setLimit()
	 * 
	 * @param	int		$offset		First result index
	 * @param	int		$length		Maximum number of results
	 * 
	 * @return	void
	 */
	public function setRange($offset, $length);
	
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
	public function setOffset($offset);
	
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
	public function setLimit($limit);
	
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
	public function setOrder(array $order);
	
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
	public function match(Criteria $criteria);
	
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
	public function equals($attribute, $value);
	
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
	public function like($attribute, $value);
	
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
	public function lowerThan($attribute, $value);
	
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
	public function lowerThanOrEqual($attribute, $value);
	
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
	public function greaterThan($attribute, $value);
	
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
	public function greaterThanOrEqual($attribute, $value);
	
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
	public function logicalOr();
	
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
	public function logicalAnd();
}