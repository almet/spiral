<?php

namespace spiral\framework\persistence\orm\backend\sql;

/**
 * MySQL dialect
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html
 */
class MySQLDialect implements SQLDialect
{
	/**
	 * Prepare a DELETE query from a SQL row
	 * 
	 * A prepared query is a query which values are replaced by logical names.
	 * Values associated to these logical names are available through the method
	 * {@link SQLDialect::prepareDeleteValues()}.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	string		Built DELETE query
	 */
	public function prepareDeleteQuery(SQLRow $sqlRow)
	{
		$query = 'DELETE FROM ';
	}
	
	/**
	 * Prepare values for the prepared DELETE query
	 * 
	 * Return an array which keys are the logical names and values are associated values.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	array		Array of values
	 */
	public function prepareDeleteValues(SQLRow $sqlRow);
	
	/**
	 * Prepare a INSERT query from a SQL row
	 * 
	 * A prepared query is a query which values are replaced by logical names.
	 * Values associated to these logical names are available through the method
	 * {@link SQLDialect::prepareInsertValues()}.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	string		Built INSERT query
	 */
	public function prepareInsertQuery(SQLRow $sqlRow);
	
	/**
	 * Prepare values for the prepared INSERT query
	 * 
	 * Return an array which keys are the logical names and values are associated values.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	array		Array of values
	 */
	public function prepareInsertValues(SQLRow $sqlRow);
	
	/**
	 * Prepare a UPDATE query from a SQL row
	 * 
	 * A prepared query is a query which values are replaced by logical names.
	 * Values associated to these logical names are available through the method
	 * {@link SQLDialect::prepareUpdateValues()}.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	string		Built UPDATE query
	 */
	public function prepareUpdateQuery(SQLRow $sqlRow);
	
	/**
	 * Prepare values for the prepared UPDATE query
	 * 
	 * Return an array which keys are the logical names and values are associated values.
	 * 
	 * @param	SQLRow		$sqlRow		SQL row
	 * @return	array		Array of values
	 */
	public function prepareUpdateValues(SQLRow $sqlRow);
	
	/**
	 * Prepare a SELECT query from a SQL select query
	 * 
	 * A prepared query is a query which values are replaced by logical names.
	 * Values associated to these logical names are available through the method
	 * {@link SQLDialect::prepareSelectValues()}.
	 * 
	 * @param	SQLSelectQuery		$query		Query
	 * @return	string				Built SELECT query
	 */
	public function prepareSelectQuery(SQLSelectQuery $query);
	
	/**
	 * Prepare values for the prepared SELECT query
	 * 
	 * Return an array which keys are the logical names and values are associated values.
	 * 
	 * @param	SQLSelectQuery		$query		Query
	 * @return	array				Array of values
	 */
	public function prepareSelectValues(SQLSelectQuery $query);
}
