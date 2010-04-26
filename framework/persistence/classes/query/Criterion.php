<?php

namespace spiral\framework\persistence\query;

/**
 * Criterion
 * 
 * Criterion is a part of a result filter. It defines a specific condition that a value must 
 * match to be added to the results list.
 *  
 * Example of use :
 * <code> 
 *	$query = $repository->createQuery('\\namespace\\to\\Artist');
 *	
 *	$criterion = $query->equals('firstName', 'James');
 *
 *	$query->match( $criterion );
 * </code>
 * 
 * You should notice that Criterion extends {@link Criteria}, so you can either use one or 
 * the other as a {@link Criteria}.
 * 
 * {@link Criteria} is a mean to group Criterion or other {@link Criteria} with a certain logic.
 * 
 * A Criterion is composed of an attribute name, a value and an operator that link the two first.
 * 
 * @see			Query::equals()
 * @see			Query::greaterThan()
 * @see			Query::greaterThanOrEqual()
 * @see			Query::lowerThan()
 * @see			Query::lowerThanOrEqual()
 * @see			Query::like()
 * @see			Query::logicalAnd()
 * @see			Query::logicalOr()
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Criterion extends Criteria
{
	/**
	 * Equality operator
	 * 
	 * @var	int
	 */
	const EQUAL = 0x01;
	
	/**
	 * Strict superiority operator
	 * 
	 * @var	int
	 */
	const GREATER_THAN = 0x02;
	
	/**
	 * Superiority operator
	 * 
	 * @var	int
	 */
	const GREATER_THAN_OR_EQUAL = 0x04;
	
	/**
	 * Strict minority operator
	 * 
	 * @var	int
	 */
	const LOWER_THAN = 0x08;
	
	/**
	 * Minority operator
	 * 
	 * @var	int
	 */
	const LOWER_THAN_OR_EQUAL = 0x10;
	
	/**
	 * Pseudo-equality operator
	 * 
	 * @var	int
	 */
	const LIKE = 0x20;
	
	/**
	 * Define the operator to use to compare attribute and value
	 * 
	 * The operator can be one of the operator defined in interface {@link Criterion}.
	 * 
	 * @param	int		$operator	Operator to use
	 * 
	 * @return	void
	 */
	public function setCriterionOperator($operator);
	
	/**
	 * Return the operator to use to compare attribute and value
	 * 
	 * The operator can be one of the operator defined in interface {@link Criterion}.
	 * 
	 * @return	int		Operator to use
	 */
	public function getCriterionOperator();
	
	/**
	 * Define the attribute that must match the value
	 * 
	 * Attributes can be chained like this :
	 * <code>
	 * $query->setClass('Album');
	 * $query->match( $query->equals('artist->name', 'James Brown') );
	 * // Will find all albums from the artist named James Brown
	 * </code>
	 * 
	 * @param	string		$attribute		Attribute that must match the value
	 * 
	 * @return	void
	 */
	public function setAttribute($attribute);
	
	/**
	 * Return the attribute that must match the value
	 * 
	 * Attributes can be chained like this :
	 * <code>
	 * $query->setClass('Album');
	 * $query->match( $query->equals('artist->name', 'James Brown') );
	 * // Will find all albums from the artist named James Brown
	 * </code>
	 * 
	 * @return	string		Attribute that must match the value
	 */
	public function getAttribute();
	
	/**
	 * Define the value that must match the attribute
	 * 
	 * @param	mixed		$value		Value that must match the attribute
	 * 
	 * @return	void
	 */
	public function setValue($value);
	
	/**
	 * Return the value that must match the attribute
	 * 
	 * @return	mixed		Value that must match the attribute
	 */
	public function getValue();
}