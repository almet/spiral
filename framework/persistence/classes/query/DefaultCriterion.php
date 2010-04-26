<?php

namespace spiral\framework\persistence\query;

/**
 * Default implementation of Criterion
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriterion implements Criterion
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
	 * Attribute
	 * 
	 * @var	string
	 */
	private $_attribute = NULL;
	
	/**
	 * Value
	 * 
	 * @var	mixed
	 */
	private $_value = NULL;
	
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
		// Keep empty
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
		return NULL;
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
		// Keep empty
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
		return NULL;
	}
	
	/**
	 * Define the operator to use
	 * 
	 * The operator can be one of the operator defined in interface {@link Criterion}.
	 * 
	 * @param	int		$operator	Operator to use
	 * 
	 * @return	void
	 */
	public function setCriterionOperator($operator)
	{
		$this->_operator = $operator;
	}
	
	/**
	 * Return the operator to use
	 * 
	 * The operator can be one of the operator defined in interface {@link Criterion}.
	 * 
	 * @return	int		Operator to use
	 */
	public function getCriterionOperator()
	{
		return $this->_operator;
	}
	
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
	public function setAttribute($attribute)
	{
		$this->_attribute = $attribute;
	}
	
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
	public function getAttribute()
	{
		return $this->_attribute;
	}
	
	/**
	 * Define the value that must match the attribute
	 * 
	 * @param	mixed		$value		Value that must match the attribute
	 * 
	 * @return	void
	 */
	public function setValue($value)
	{
		$this->_value = $value;
	}
	
	/**
	 * Return the value that must match the attribute
	 * 
	 * @return	mixed		Value that must match the attribute
	 */
	public function getValue()
	{
		return $this->_value;
	}
}