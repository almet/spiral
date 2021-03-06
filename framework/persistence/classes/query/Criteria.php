<?php

namespace spiral\framework\persistence\query;

/**
 * Criteria
 * 
 * Criteria is a group of other Criteria with a logical relation between them.
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
 * </code>
 * 
 * You should notice that {@link Criterion} extends Criteria, so you can either use one or 
 * the other as a Criteria.
 * 
 * Possible logical relations between Criteria are AND or OR.
 * 
 * @see			Query::logicalAnd()
 * @see			Query::logicalOr()
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Criteria
{
	/**
	 * Logical AND
	 * 
	 * @var	int
	 */
	const LOGICAL_AND = 1;
	
	/**
	 * Logical OR
	 * 
	 * @var	int
	 */
	const LOGICAL_OR = 2;
	
	/**
	 * Define the logical operator to use
	 * 
	 * The logical operator can be one of the operator defined in interface {@link Criteria}.
	 * 
	 * @param	int		$operator	Logical operator to use
	 * 
	 * @return	void
	 */
	public function setCriteriaOperator($operator);
	
	/**
	 * Return the logical operator to use
	 * 
	 * The logical operator can be one of the operator defined in interface {@link Criteria}.
	 * 
	 * @return	int		Logical operator to use
	 */
	public function getCriteriaOperator();
	
	/**
	 * Define the array of criteria to group
	 * 
	 * If this array is empty, it means that no values are to be grouped, 
	 * in other terms you're facing a {@link Criterion}.
	 * 
	 * @param	array		$criteriaArray		Array of criteria
	 * 
	 * @return	void
	 */
	public function setCriteriaArray(array $criteriaArray);
	
	/**
	 * Return the array of criteria to group
	 * 
	 * If this array is empty, it means that no values are to be grouped, 
	 * in other terms you're facing a {@link Criterion}.
	 * 
	 * @return	array		Array of criteria
	 */
	public function getCriteriaArray();
}