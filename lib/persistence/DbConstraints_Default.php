<?php

/**
 * Default implementation of DbConstraints interface
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class DbConstraints_Default extends Constraints_Default implements DbConstraints
{
	/**
	 * Tables
	 *
	 * @var	array
	 */
	private $_tables = null;
	
	/**
	 * Return the tables
	 *
	 * @return	array
	 */
	public function getTables()
	{
		return $this->_tables;
	}
	
	/**
	 * Set the tables
	 *
	 * @param	array		$tables
	 * 
	 * @return 	void
	 */
	public function setTables(array $tables)
	{
		$this->_tables = $tables;
	}
}

?>