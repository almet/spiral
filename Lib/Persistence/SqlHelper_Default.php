<?php

/**
 * Default SQL helper
 *
 * This component is the default implementation of SqlHelper interface.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class SqlHelper_Default implements SqlHelper
{
	/**
	 * Operators real values
	 *
	 * @var	array
	 */
	static private $_operators = array(Criteria::EQUAL=>'=',
										Criteria::GREATER_THAN=>'>=',
										Criteria::GREATER_THAN_STRICT=>'>',
										Criteria::IN=>'IN',
										Criteria::LIKE=>'LIKE',
										Criteria::LOWER_THAN=>'<=',
										Criteria::LOWER_THAN_STRICT=>'<',
										Criteria::NOT_EQUAL=>'<>',
										Criteria::NOT_IN=>'NOT IN');
	
	/**
	 * Build query constraints
	 *
	 * @param	DbConstraints		$constraints
	 * 
	 * @return 	string
	 */
	protected function _buildConstraints(DbConstraints $constraints)
	{
		// Retrieve informations from the constraints
		$limit = $constraints->getLimit();
		$offset = $constraints->getOffset();
		$orderConstraints = $constraints->getOrderConstraints();
		
		// Build parts of the string
		$where = $this->_buildWhere($constraints);
		$range = $this->_buildRange($limit, $offset);
		$orderBy = $this->_buildOrderBy($orderConstraints);
		
		return $where.' '.$orderBy.' '.$range;
	}
	
	/**
	 * Build criterias string
	 *
	 * @param	CriteriaContainer		$criteriaContainer
	 * 
	 * @return 	string
	 */
	protected function _buildCriterias(CriteriaContainer $criteriaContainer)
	{
		// Build criterias
		$criterias = $criteriaContainer->getCriterias();
		
		foreach($criterias as $c)
		{
			$operator = self::$_operators[$c->getOperator()];
			
			$criteriaStrings[] = $c->getAttribute().' '.$operator.' :'.$c->getValue();
		}
		
		// Recursively build sub-containers
		$containers = $criteriaContainer->getContainers();
		
		foreach($containers as $c)
		{
			$criteriaStrings[] = '( '.$this->_buildCriterias($c).' )';
		}
		
		$separator = $criteriaContainer->getType() == CriteriaContainer::TYPE_AND ? ' AND ' : ' OR ';
		$criteriaString = implode($separator, $criteriaStrings);
		
		return $criteriaString;
	}
	
	/**
	 * Build LIMIT statement
	 *
	 * @param	int		$limit
	 * 
	 * @return 	string
	 */
	protected function _buildLimit($limit)
	{
		// Check type of parameters
		assert('is_int($limit)');
		
		return 'LIMIT '.$limit;
	}
	
	/**
	 * Build OFFSET statement
	 *
	 * @param 	int		$offset
	 * 
	 * @return 	string
	 */
	protected function _buildOffset($offset)
	{
		// Check type of parameters
		assert('is_int($offset)');
		
		return 'OFFSET '.$offset;
	}
	
	/**
	 * Build ORDER BY statement
	 *
	 * @param 	array		$orderConstraints
	 * 
	 * @return 	string
	 */
	protected function _buildOrderBy(array $orderConstraints)
	{
		foreach($orderConstraints as $orderConstraint)
		{
			$sens = $orderConstraint['order'] == DbConstraints::ASC ? 'ASC' : 'DESC';
			$orderConstraintStrings[] = $orderConstraint['attribute'].' '.$sens;
		}
		
		$orderConstraintString = implode(', ', $orderConstraintStrings);
		
		return 'ORDER BY '.$orderConstraintString;
	}
	
	/**
	 * Build range statement
	 *
	 * @param	int		$limit
	 * @param 	int		$offset
	 * 
	 * @return 	string
	 */
	protected function _buildRange($limit, $offset)
	{
		$limitString = $this->_buildLimit($limit);
		$offsetString = $this->_buildOffset($offset);
		
		return $limitString.' '.$offsetString;
	}
	
	/**
	 * Build query tables string
	 *
	 * @param	array		$tables
	 * 
	 * @return 	string
	 */
	protected function _buildTables(array $tables)
	{
		return implode(', ', $tables);
	}
	
	/**
	 * Build WHERE statement
	 *
	 * @param	CriteriaContainer		$criteriaContainer
	 * 
	 * @return 	string
	 */
	protected function _buildWhere(CriteriaContainer $criteriaContainer)
	{
		$criteriaString = $this->_buildCriterias($criteriaContainer);
		
		return 'WHERE '.$criteriaString;
	}
	
	/**
	 * Build a DELETE query
	 *
	 * @param	DbConstraints	$constraints
	 * 
	 * @return 	string
	 */
	public function buildDelete(DbConstraints $constraints)
	{
		$tables = $constraints->getTables();
		
		$tablesString = $this->_buildTables($tables);
		$whereString = $this->_buildWhere($constraints);
		
		return 'DELETE FROM '.$tablesString.' '.$whereString;
	}
	
	/**
	 * Build an INSERT query
	 *
	 * @param	array		$tables
	 * @param	array		$fields
	 * 
	 * @return 	string
	 */
	public function buildInsert(array $tables, array $fields)
	{
		$tablesString = $this->_buildTables($tables);
		
		foreach($fields as $key=>$fieldName)
		{
			$fieldsStrings[] = $fieldName;
			$valuesStrings[] = ':'.$key;
		}
		
		$fieldsString = implode(', ', $fieldsStrings);
		$valuesString = implode(', ', $valuesStrings);
		
		return 'INSERT INTO '.$tablesString.'('.$fieldsString.') VALUES('.$valuesString.')';
	}
	
	/**
	 * Build a SELECT query
	 *
	 * @param	DbConstraints		$constraints
	 * 
	 * @return	string
	 */
	public function buildSelect(DbConstraints $constraints)
	{
		$tables = $constraints->getTables();
		
		$tablesString = $this->_buildTables($tables);
		$constraintsString = $this->_buildConstraints($constraints);
		
		return 'SELECT * FROM '.$tablesString.' '.$constraintsString;
	}
	
	/**
	 * Build an UPDATE query
	 *
	 * @param	DbConstraints		$constraints
	 * @param	array				$fields
	 * 
	 * @return 	string
	 */
	public function buildUpdate(DbConstraints $constraints, array $fields)
	{
		$tables = $constraints->getTables();
		
		$tablesString = $this->_buildTables($tables);
		$whereString = $this->_buildWhere($constraints);
		
		foreach($fields as $key=>$fieldName)
		{
			$assignStrings[] = $fieldName.' = :'.$key;
		}
		
		$assignString = implode(', ', $assignStrings);
		
		return 'UPDATE '.$tablesString.' SET '.$assignString.' '.$whereString;
	}
}

?>