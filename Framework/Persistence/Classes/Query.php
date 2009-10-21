<?php

namespace Spiral\Framework\Persistence;

/**
 * Query
 * 
 * A query is the way to find objects by criteria in a repository.
 * 
 * There are different solutions to create a new query :
 * 
 * - Use the {@link Repository::createQuery()} method to create a new empty query.
 *   The query is then a {@link FluentQuery}.
 * - ... 
 * @todo	Comment about query creation
 * 
 * You can add criteria to the query using FluentQuery methods. Read this doc, it's quite intuitive !
 * 
 * @see			Repository::find()
 * @see			Repository::createQuery()
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
interface Query
{
	/**
	 * Ascending order
	 * 
	 * @var	int
	 */
	const ORDER_ASC = 1;
	
	/**
	 * Descending order
	 * 
	 * @var	int
	 */
	const ORDER_DESC = 2;
	
	/**
	 * @todo	Comment this method
	 */
	public function setClass($class);
	
	/**
	 * Set the range of the results
	 * 
	 * This method is a shortcut to define both the first result and the maximum number of results.
	 * 
	 * @see		Query::setOffset()
	 * @see		Query::setLimit()
	 * 
	 * @param	int		$firstResult		First result index
	 * @param	int		$maximumResults		Maximum number of results
	 * 
	 * @return	Query	Return the current instance (fluent interface)
	 */
	public function setRange($firstResult, $maximumResults);
	
	/**
	 * Set the first result
	 * 
	 * Define the index from which results will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if first result is 7, only the 3 last objects 
	 * will be returned.
	 * 
	 * The default value is 0.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setLimit()
	 * 
	 * @param	int		$firstResult		First result index
	 * 
	 * @return	Query	Return the current instance (fluent interface)
	 */
	public function setFirstResult($firstResult);
	
	/**
	 * Set the maximum results length
	 * 
	 * Define the number of results that will be returned.
	 * 
	 * For example, if 10 objects are matching the query, if maximum reuslts is 7, only the 7 first 
	 * objects will be returned.
	 * 
	 * If null, all results will be returned.
	 * 
	 * The default value is null.
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setOffset()
	 * 
	 * @param	int		$maximumResults		Maximum number of results
	 * 
	 * @return	Query	Return the current instance (fluent interface)
	 */
	public function setMaximumResults($maximumResults);
	
	/**
	 * Set the rules for sorting objects
	 * 
	 * An array of the attributes associated to their ordering value.
	 * 
	 * Example :
	 * <code>
	 * $order = array('name'=>ORDER_ASC, 'age'=>ORDER_DESC);
	 * 
	 * $query->setOrder($order);
	 * // Will sort objects by name from A to Z, then by age from the older to the younger
	 * </code>
	 * 
	 * @see		Query::setRange()
	 * @see		Query::setOffset()
	 * 
	 * @param	int		$limit		Limit
	 * 
	 * @return	Query	Return the current instance (fluent interface)
	 */
	public function setOrder($order);
	
	/**
	 * Add a constraint to the query
	 * 
	 * @param	Constraint	$constraint		The constraint the query must match
	 * 
	 * @return	Query	Return the current instance (fluent interface)
	 */
	public function matching(Constraint $constraint);
	
	/**
	 * Create a "with OID" criterion
	 * 
	 * Define that an object must have a certain OID.
	 * 
	 * Example :
	 * <code>
	 * $query->withOID($oid);
	 * // Will find the artist whose OID is specified
	 * // Equivalent to $repository->findByOID($oid);
	 * </code>
	 * 
	 * @param	string	$attribute		Attribute you want to match the value
	 * @param	mixed	$value			Value
	 * 
	 * @return	Criterion	A "with OID" criterion
	 */
	public function withOID($oid);
	
	/**
	 * Create a criterion of equality
	 * 
	 * Define that an attribute must be equal to a certain value.
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->matching( $query->equals('name', 'James Brown') );
	 * // Will find all artists whose name are James Brown
	 * </code>
	 * 
	 * Attributes can be chained like this :
	 * <code>
	 * $query->setClass('Album');
	 * $query->matching( $query->equals('artist->name', 'James Brown') );
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
	 * $query->matching( $query->equals('name', 'James %') );
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
	 * $query->matching( $query->lowerThan('age', 50) );
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
	 * $query->matching( $query->lowerThanOrEqual('age', 50) );
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
	 * $query->matching( $query->greaterThan('age', 50) );
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
	 * $query->matching( $query->greaterThanOrEqual('age', 50) );
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
	 * $query->matching( $query->logicalOr( $query->greaterThan('age', 50),
	 * 										$query->lowerThan('age', 20) ) );
	 * // Will find all the artists older than 50 or younger than 20
	 * </code>
	 * 
	 * @param	Constraint	...		Constraint instances to group in an OR logic
	 * 
	 * @return	Criteria	A criteria grouping criterion with an OR logic
	 */
	public function logicalOr();
	
	/**
	 * Group criteria with AND logic
	 * 
	 * Example :
	 * <code>
	 * $query->setClass('Artist');
	 * $query->matching( $query->logicalAnd( $query->greaterThan('age', 20),
	 * 										$query->lowerThan('age', 50) ) );
	 * // Will find all the artists whose age is between 20 and 50
	 * </code>
	 * 
	 * @param	Constraint	...		Constraint instances to group in an AND logic
	 * 
	 * @return	Criteria	A criteria grouping criterion with an AND logic
	 */
	public function logicalAnd();
}