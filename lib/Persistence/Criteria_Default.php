<?php

/**
 * Default implementation of Criteria interface
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Criteria_Default implements Criteria
{
	/**
	 * Attribute
	 *
	 * @var	string
	 */
	private $_attribute = null;
	
	/**
	 * Operator
	 *
	 * Must be one of Criteria interface operator constants.
	 * 
	 * @var	int
	 */
	private $_operator = null;
	
	/**
	 * Constraint type
	 *
	 * Must be one of Criteria interface type constants.
	 * Criteria interface type constants start by Criteria::TYPE_*.
	 * 
	 * @var	int
	 */
	private $_type = null;
	
	/**
	 * Value
	 *
	 * @var mixed
	 */
	private $_value = null;
	
	/**
	 * Constructor
	 *
	 * @param	int			$type
	 * @param	string		$attribute
	 * @param	mixed		$value
	 * @param	int			$operator
	 */
	public function __construct($type, $attribute, $value, $operator = Criteria::EQUAL)
	{
		$this->setType($type);
		$this->setAttribute($attribute);
		$this->setValue($value);
		$this->setOperator($operator);
	}
	
	/**
	 * Return attribute
	 *
	 * @return	string
	 */
	public function getAttribute()
	{
		return $this->_attribute;
	}
	
	/**
	 * Return operator
	 *
	 * Return one of the Criteria interface operator constants.
	 * 
	 * @return	int
	 */
	public function getOperator()
	{
		return $this->_operator;
	}
	
	/**
	 * Return type of constraint
	 *
	 * The type is one of Criteria interface type constants.
	 * Criteria interface type constants start by Criteria::TYPE_*.
	 * 
	 * @return	int
	 */
	public function getType()
	{
		return $this->_type;
	}
	
	/**
	 * Return value
	 *
	 * @return	mixed
	 */
	public function getValue()
	{
		return $this->_value;
	}
	
	/**
	 * Set attribute
	 *
	 * @param	string		$attribute
	 * 
	 * @return	void
	 */
	public function setAttribute($attribute)
	{
		// Check type of parameters
		assert('is_string($attribute)');
		
		$this->_attribute = $attribute;
	}
	
	/**
	 * Set operator
	 *
	 * The operator must be one of Criteria interface operator constants.
	 * 
	 * @param	int			$operator
	 * 
	 * @return	void
	 */
	public function setOperator($operator)
	{
		// Check type of parameters
		assert('$operator == Criteria::EQUAL ||
				$operator == Criteria::LIKE ||
				$operator == Criteria::NOT_EQUAL ||
				$operator == Criteria::LOWER_THAN ||
				$operator == Criteria::GREATER_THAN ||
				$operator == Criteria::LOWER_THAN_STRICT ||
				$operator == Criteria::GREATER_THAN_STRICT ||
				$operator == Criteria::IN ||
				$operator == Criteria::NOT_IN');
		
		$this->_operator = $operator;
	}
	
	/**
	 * Set type of constraint
	 *
	 * The type must be one of Criteria interface type constants.
	 * Criteria interface type constants start by Criteria::TYPE_*.
	 * 
	 * @param	int		$type
	 * 
	 * @return	void
	 */
	public function setType($type)
	{
		// Check type of parameters
		assert('$type == Criteria::TYPE_PARAMETER ||
				$type == Criteria::TYPE_VALUE ||
				$type == Criteria::TYPE_JOIN');
		
		$this->_type = $type;
	}
	
	/**
	 * Set value
	 *
	 * @param	mixed		$value
	 * 
	 * @return	void
	 */
	public function setValue($value)
	{
		$this->_value = $value;
	}
}

?>