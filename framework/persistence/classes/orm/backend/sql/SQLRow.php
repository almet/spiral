<?php

namespace spiral\framework\persistence\orm\backend\sql;

/**
 * SQL row
 * 
 * A SQL row contains information on a database row.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html
 */
interface SQLRow
{
	/**
	 * Return columns of the row
	 * 
	 * Columns are presented as an associative array.
	 * Keys are column names and values are associated values.
	 * 
	 * @return	array		Columns of the row
	 */
	public function getColumns();
	
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
	public function setColumns(array $columns);
	
	/**
	 * Return the table of which the row belong
	 * 
	 * @return	string		Table name
	 */
	public function getTableName();
	
	/**
	 * Define the table of which the row belong
	 * 
	 * @param	string		$tableName 	Table name
	 * 
	 * @return	void
	 */
	public function setTableName($tableName);
}
