<?php

/**
 * Criteria
 * 
 * This component represents a criteria on an entity attribute to had constraints to select features for example.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface Criteria
{
	/**
	 * Equal operator
	 * 
	 * Force the field to be equal to the value.
	 *
	 * @var	int
	 */
	const EQUAL = 0;
	
	/**
	 * Like operator
	 *
	 * Force the field to match the regular expression
	 * 
	 * @var	int
	 */
	const LIKE = 1;
	
	/**
	 * Not equal operator
	 * 
	 * Force the field to be not equal to the value.
	 *
	 * @var	int
	 */
	const NOT_EQUAL = 2;
	
	/**
	 * Lower than operator
	 * 
	 * Force the field to be lower than the value or equal.
	 *
	 * @var	int
	 */
	const LOWER_THAN = 3;
	
	/**
	 * Greater than operator
	 * 
	 * Force the field to be greater than the value or equal.
	 *
	 * @var	int
	 */
	const GREATER_THAN = 4;
	
	/**
	 * Lower than strict operator
	 * 
	 * Force the field to be strictly lower than the value.
	 *
	 * 
	 * @var	int
	 */
	const LOWER_THAN_STRICT = 5;
	
	/**
	 * Greater than strict operator
	 * 
	 * Force the field to be strictly greater than the value.
	 *
	 * @var	int
	 */
	const GREATER_THAN_STRICT = 6;
	
	/**
	 * In operator
	 * 
	 * Force the field to be in the array of values.
	 *
	 * @var	int
	 */
	const IN = 7;
	
	/**
	 * Not in operator
	 * 
	 * Force the field not to be in the array of values.
	 *
	 * @var	int
	 */
	const NOT_IN = 8;
	
	/**
	 * Value type of constraint
	 * 
	 * This type of constraint defines that the field name must have the value set in value.
	 * 
	 * @var	int
	 */
	const TYPE_VALUE = 0;
	
	/**
	 * Join type of constraint
	 * 
	 * This type of constraint defines that the field name must have the same value as the 
	 * value of the field which name is set in value.
	 * 
	 * @var	int
	 */
	const TYPE_JOIN = 1;
	
	/**
	 * Parameter type of constraint
	 * 
	 * When using a parameter criteria, you are associating a field name with a parameter name.
	 * The value attribute of criteria will contain the name of parameter.
	 * The value of this parameter will be given later by the user.
	 * 
	 * @var	int
	 */
	const TYPE_PARAMETER = 2;
	
	/**
	 * Return attribute
	 *
	 * @return	string
	 */
	public function getAttribute();
	
	/**
	 * Return operator
	 *
	 * Return one of the Criteria interface operator constants.
	 * 
	 * @return	int
	 */
	public function getOperator();
	
	/**
	 * Return type of constraint
	 *
	 * The type is one of Criteria interface type constants.
	 * Criteria interface type constants start by Criteria::TYPE_*.
	 * 
	 * @return	int
	 */
	public function getType();
	
	/**
	 * Return value
	 *
	 * @return	mixed
	 */
	public function getValue();
	
	/**
	 * Set attribute
	 *
	 * @param	string		$attribute
	 * 
	 * @return	void
	 */
	public function setAttribute($attribute);
	
	/**
	 * Set operator
	 *
	 * The operator must be one of Criteria interface operator constants.
	 * 
	 * @param	int			$operator
	 * 
	 * @return	void
	 */
	public function setOperator($operator);
	
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
	public function setType($type);
	
	/**
	 * Set value
	 *
	 * @param	mixed		$value
	 * 
	 * @return	void
	 */
	public function setValue($value);
}

?>