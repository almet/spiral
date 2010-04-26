<?php

namespace spiral\framework\persistence\query;

/**
 * Default implementation of Criteria
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriteria implements Criteria
{
	/**
	 * Operator
	 * 
	 * One of the declared in Criteria interface
	 * 
	 * @var	int
	 */
	private $_operator = NULL;
	
	/**
	 * Criteria array
	 * 
	 * List of all criteria to group with the operator
	 * 
	 * @var	array
	 */
	private $_criteriaArray = array();
	
	/**
	 * Define the logical operator to use
	 * 
	 * The logical operator can be one of the operator defined in interface {@link Criteria}.
	 * 
	 * @param	int		$operator	Logical operator to use
	 * 
	 * @return	void
	 */
	public function setCriteriaOperator($operator)
	{
		$this->_operator = $operator;
	}
	
	/**
	 * Return the logical operator to use
	 * 
	 * The logical operator can be one of the operator defined in interface {@link Criteria}.
	 * 
	 * @return	int		Logical operator to use
	 */
	public function getCriteriaOperator()
	{
		return $this->_operator;
	}
	
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
	public function setCriteriaArray(array $criteriaArray)
	{
		$this->_criteriaArray = $criteriaArray;
	}
	
	/**
	 * Return the array of criteria to group
	 * 
	 * If this array is empty, it means that no values are to be grouped, 
	 * in other terms you're facing a {@link Criterion}.
	 * 
	 * @return	array		Array of criteria
	 */
	public function getCriteriaArray()
	{
		return $this->_criteriaArray;
	}
}