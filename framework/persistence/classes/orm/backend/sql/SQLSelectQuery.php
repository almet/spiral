<?php

namespace spiral\framework\persistence\orm\backend\sql;

/**
 * SQL select query
 * 
 * A SQL select query is an adaptation from the {@link Query} to the SQL vocabulary.
 * 
 * @see			Query
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2010 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface SQLSelectQuery
{
	/**
	 * Ascending order
	 * 
	 * @var	int
	 */
	const ASCENDING = 1;
	
	/**
	 * Descending order
	 * 
	 * @var	int
	 */
	const DESCENDING = 2;
	
	/**
	 * Define the table name of rows targeted by the query
	 * 
	 * @param	string	$tableName		Table name of the rows targeted
	 * 
	 * @return	void
	 */
	public function setTableName($tableName);
	
	/**
	 * Return the table name of rows that are targeted by the query
	 * 
	 * @return	string	Table name of queried rows
	 */
	public function getTableName();
	
	/**
	 * Define the range of the results
	 * 
	 * This method is a shortcut to define both the offset and the limit of results in one time.
	 * 
	 * @see		SQLSelectQuery::setOffset()
	 * @see		SQLSelectQuery::setLimit()
	 * 
	 * @param	int		$offset		First result index
	 * @param	int		$limit		Maximum number of results
	 * 
	 * @return	void
	 */
	public function setRange($offset, $limit);
	
	/**
	 * Define the first result index value (offset)
	 * 
	 * Define the first index from which results will be returned.
	 * 
	 * For example, if 10 rows are matching the query, if first result is 7, only the 3 last rows 
	 * will be returned.
	 * 
	 * The default value is 0.
	 * 
	 * @see		SQLSelectQuery::setRange()
	 * @see		SQLSelectQuery::setLimit()
	 * 
	 * @param	int		$offset		First result index
	 * 
	 * @return	void
	 */
	public function setOffset($offset);
	
	/**
	 * Return the first result index value (offset)
	 * 
	 * Return the first index from which results will be returned.
	 * 
	 * For example, if 10 rows are matching the query, if first result is 7, only the 3 last rows 
	 * will be returned.
	 * 
	 * The default value is 0.
	 * 
	 * @see		SQLSelectQuery::setRange()
	 * @see		SQLSelectQuery::setLimit()
	 * 
	 * @return	int		First result index
	 */
	public function getOffset();
	
	/**
	 * Define the maximum number of results that will be returned.
	 * 
	 * For example, if 10 rows are matching the query, if limit is 7, only the 7 first 
	 * rows will be returned.
	 * 
	 * If the limit value is greater than the number of results, all the results will be returned.
	 * 
	 * If null, all results will be returned.
	 * 
	 * The default value is null.
	 * 
	 * @see		SQLSelectQuery::setRange()
	 * @see		SQLSelectQuery::setOffset()
	 * 
	 * @param	int		$limit		Maximum number of results
	 * 
	 * @return	void
	 */
	public function setLimit($limit);
	
	/**
	 * Return the maximum number of results that will be returned.
	 * 
	 * For example, if 10 rows are matching the query, if limit is 7, only the 7 first 
	 * rows will be returned.
	 * 
	 * If the limit value is greater than the number of results, all the results will be returned.
	 * 
	 * If null, all results will be returned.
	 * 
	 * The default value is null.
	 * 
	 * @see		SQLSelectQuery::setRange()
	 * @see		SQLSelectQuery::setOffset()
	 * 
	 * @param	int		Maximum number of results
	 */
	public function getLimit();
	
	/**
	 * Set the rules for sorting rows
	 * 
	 * An array of the attributes associated to their ordering value.
	 * 
	 * Keys of the array are attribute names and values are order mode (SQLSelectQuery::ASCENDING or SQLSelectQuery::DESCENDING)
	 * 
	 * Example :
	 * <code>
	 * $order = array('name'=>SQLSelectQuery::ASCENDING, 'age'=>SQLSelectQuery::DESCENDING);
	 * 
	 * $query->setOrder($order);
	 * // Will sort rows by name from A to Z, then by age from the older to the younger
	 * </code>
	 * 
	 * @param	array		$order		Array of parameters with ordering mode
	 * 
	 * @return	void
	 */
	public function setOrder(array $order);
	
	/**
	 * Return the rules for sorting rows
	 * 
	 * An array of the attributes associated to their ordering value.
	 * 
	 * Keys of the array are attribute names and values are order mode (SQLSelectQuery::ASCENDING or SQLSelectQuery::DESCENDING)
	 * 
	 * Example :
	 * <code>
	 * $order = array('name'=>SQLSelectQuery::ASCENDING, 'age'=>SQLSelectQuery::DESCENDING);
	 * 
	 * $query->setOrder($order);
	 * // Will sort rows by name from A to Z, then by age from the older to the younger
	 * </code>
	 * 
	 * @return	array		Array of parameters with ordering mode
	 */
	public function getOrder();
	
	/**
	 * Define criteria that will be respected to filter results
	 * 
	 * More information on criteria definition should be given in the {@link SQLCriteria} documentation.
	 * 
	 * You could notice that since {@link SQLCriterion} extends {@link SQLCriteria}, a simple {@link SQLCriterion}
	 * can be used instead of {@link SQLCriteria}.
	 * 
	 * @see		SQLCriteria
	 * @see		SQLCriterion
	 * 
	 * @param	SQLCriteria		$criteria		Criteria that the query must match
	 * 
	 * @return	void
	 */
	public function match(SQLCriteria $criteria);
	
	/**
	 * Return criteria that will be respected to filter results
	 * 
	 * More information on criteria definition should be given in the {@link SQLCriteria} documentation.
	 * 
	 * You could notice that since {@link SQLCriterion} extends {@link SQLCriteria}, a simple {@link SQLCriterion}
	 * can be used instead of {@link SQLCriteria}.
	 * 
	 * @see		SQLCriteria
	 * @see		SQLCriterion
	 * 
	 * @return	SQLCriteria		Criteria that the query must match
	 */
	public function getCriteria();
}