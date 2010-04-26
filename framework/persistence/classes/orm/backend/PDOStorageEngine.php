<?php

namespace spiral\framework\persistence\orm\backend;

use \spiral\framework\persistence\orm\backend\sql\SQLDialect;
use \spiral\framework\persistence\orm\meta\MetaObject;
use \spiral\framework\persistence\query\Query;
use \PDO;

/**
 * Implementation of storage engine for PDO
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html
 */
class PDOStorageEngine implements StorageEngine
{
	/**
	 * PDO instance
	 * 
	 * Instance of PDO to use for accessing the database
	 * 
	 * @var	PDO
	 */
	private $_pdo = NULL;
	
	/**
	 * SQL dialect to use for generating SQL strings
	 * 
	 * @var	SQLDialect
	 */
	private $_sqlDialect = NULL;
	
	/**
	 * Delete the meta object from the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function delete(MetaObject $metaObject)
	{
		
	}
	
	/**
	 * Insert the meta object in the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function insert(MetaObject $metaObject)
	{
		
	}
	
	/**
	 * Update the meta object in the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function update(MetaObject $metaObject)
	{
		
	}
	
	/**
	 * Select objects in the storage engine by {@link Query}.
	 * 
	 * Returns an array of {@link MetaObject}s that matches the query.
	 * 
	 * @param	Query	$query		Query
	 * @return	array	Array of meta objects that matches the query
	 */
	public function select(Query $query)
	{
		
	}
	
	/**
	 * Define the PDO instance
	 * 
	 * @param	PDO		$pdo		PDO instance
	 * @return	void
	 */
	public function setPDOInstance(PDO $pdo)
	{
		$this->_pdo = $pdo;
	}
	
	/**
	 * Define the SQL dialect instance
	 * 
	 * @param	SQLDialect		$sqlDialect		SQL dialect
	 * @return	void
	 */
	public function setSQLDialect(SQLDialect $sqlDialect)
	{
		$this->_sqlDialect = $sqlDialect;
	}
}
