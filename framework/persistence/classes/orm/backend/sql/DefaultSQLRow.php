<?php

namespace spiral\framework\persistence\orm\backend\sql;

/**
 * Default implementation of SQL row
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html
 */
class DefaultSQLRow implements SQLRow
{
	/**
	 * Columns of the row
	 * 
	 * @var array
	 */
	private $_columns = array();
	
	/**
	 * Table name which the row belong to
	 * 
	 * @var string
	 */
	private $_tableName = NULL;
	
	/**
	 * Return columns of the row
	 * 
	 * Columns are presented as an associative array.
	 * Keys are column names and values are associated values.
	 * 
	 * @return	array		Columns of the row
	 */
	public function getColumns()
	{
		return $this->_columns;
	}
	
	/**
	 * Define columns of the row
	 * 
	 * Columns are presented as an associative array.
	 * Keys are column names and values are associated values.
	 * 
	 * @param	array		$columns 	Columns of the row
	 * 
	 * @return	void
	 */
	public function setColumns(array $columns)
	{
		$this->_columns = $columns;
	}
	
	/**
	 * Return the table of which the row belong
	 * 
	 * @return	string		Table name
	 */
	public function getTableName()
	{
		return $this->_tableName;
	}
	
	/**
	 * Define the table of which the row belong
	 * 
	 * @param	string		$tableName 	Table name
	 * 
	 * @return	void
	 */
	public function setTableName($tableName)
	{
		$this->_tableName = $tableName;
	}
}
