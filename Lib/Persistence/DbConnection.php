<?php

/**
 * Database connection
 *
 * This component represents a database connection.
 * You have to use the specified SQL dialect to communicate with it.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface DbConnection
{
	/**
	 * Return the last inserted identifier
	 *
	 * @return 	mixed
	 */
	public function getLastInsertedId();
	
	/**
	 * Prepare and send the SQL query
	 *
	 * Return fetched results in an array if existing.
	 * 
	 * @param	string		$sqlQuery
	 * @param	array		$parameters
	 * 
	 * @return 	array
	 */
	public function query($sqlQuery, array $parameters);
}

?>