<?php

/**
 * Database constraints
 * 
 * Constraints used to communicate with SQL helper.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface DbConstraints extends Constraints
{
	/**
	 * Return the tables
	 *
	 * @return	array
	 */
	public function getTables();
	
	/**
	 * Set the tables
	 *
	 * @param	array		$tables
	 * 
	 * @return 	void
	 */
	public function setTables(array $tables);
}

?>