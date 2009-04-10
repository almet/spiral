<?php

/**
 * SQL helper
 *
 * This component helps to build SQL queries.
 * An SQL helper implementation follows a SQL dialect.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface SqlHelper
{
	/**
	 * Build a DELETE query
	 *
	 * @param	DbConstraints	$constraints
	 * 
	 * @return 	string
	 */
	public function buildDelete(DbConstraints $constraints);
	
	/**
	 * Build an INSERT query
	 *
	 * @param	array		$tables
	 * @param	array		$fields
	 * 
	 * @return 	string
	 */
	public function buildInsert(array $tables, array $fields);
	
	/**
	 * Build a SELECT query
	 *
	 * @param	DbConstraints		$constraints
	 * 
	 * @return	string
	 */
	public function buildSelect(DbConstraints $constraints);
	
	/**
	 * Build an UPDATE query
	 *
	 * @param	DbConstraints		$constraints
	 * @param	array				$fields
	 * 
	 * @return 	string
	 */
	public function buildUpdate(DbConstraints $constraints, array $fields);
}

?>