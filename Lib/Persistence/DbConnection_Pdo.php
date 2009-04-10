<?php

/**
 * PDO adapter for DbConnection interface
 *
 * This class adapt the PDO specific interface to DbConnection interface.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class DbConnection_Pdo implements DbConnection
{
	/**
	 * PDO instance
	 *
	 * @var	PDO
	 */
	private $_pdo = null;
	
	/**
	 * Constructor
	 *
	 * @param	PDO		$pdo
	 * 
	 * @return 	void
	 */
	public function __construct(PDO $pdo)
	{
		$this->setPdo($pdo);
	}
	
	/**
	 * Return the last inserted identifier
	 *
	 * @pre		The PDO instance is well defined
	 * 
	 * @return 	mixed
	 */
	public function getLastInsertedId()
	{
		assert('$this->getPdo() instanceof PDO');
		return $this->getPdo()->lastInsertId();
	}
	
	/**
	 * Return PDO instance
	 *
	 * @return 	PDO
	 */
	public function getPdo()
	{
		return $this->_pdo;
	}
	
	/**
	 * Prepare and send the SQL query
	 *
	 * Return fetched results in an array if existing.
	 * 
	 * @param	string		$sqlQuery
	 * @param	array		$parameters
	 * 
	 * @pre		The PDO instance is well defined
	 * 
	 * @return 	array
	 */
	public function query($sqlQuery, array $parameters)
	{
		// Check type of parameters
		assert('is_string($sqlQuery)');
		
		// Prepare and send query
		assert('$this->getPdo() instanceof PDO');
		$stmt = $this->getPdo()->prepare($sqlQuery);
		$result = $stmt->execute($parameters);
		
		// Return results if existing
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Set PDO instance
	 *
	 * @param	PDO		$pdo
	 * 
	 * @return 	void
	 */
	public function setPdo(PDO $pdo)
	{
		$this->_pdo = $pdo;
	}
}

?>