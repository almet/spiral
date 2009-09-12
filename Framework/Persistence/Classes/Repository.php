<?php

namespace \Spiral\Framework\Persistence;

/**
 * Object repository
 * 
 * A repository acts like an object collection to the end user.
 * You just have to add or remove object into the repository to make these objects persist or not.
 * 
 * Example :
 * <code>
 * $oid = $repository->add($object);
 * $repository->remove($object);
 * </code>
 * 
 * The repository manages unique identifiers for the objects it stores.
 * These identifiers are called OID (for Object IDentifier).
 * 
 * You can then use this OID to find an object directly in the repository.
 * 
 * You can also query objects inside the repository with advanced criteria.
 * See the {@link Query} interface to learn how to query objects in the repository.
 * 
 * @see			Query
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 * 
 * @todo		Define the type of OIDs
 */
interface Repository
{
	/**
	 * Add an object to the repository
	 * 
	 * @param	object	$object		The object to add
	 * 
	 * @return	mixed	The OID
	 * 
	 * @todo	Define the type for OIDs
	 */
	public function add($object);
	
	/**
	 * Remove an object from the repository
	 * 
	 * @param	object	$object		The object to remove
	 * 
	 * @return	void
	 */
	public function remove($object);
	
	/**
	 * Find an object in the repository by its OID
	 * 
	 * Return null if no object with this OID can be found.
	 * 
	 * @param	mixed	$oid		The OID of the object you want to find
	 * 
	 * @return	object|NULL			The object corresponding to the OID or NULL if no object found
	 */
	public function findByOID($oid);
	
	/**
	 * Find objects in the repository using a query
	 * 
	 * Return an array containing all objects that match the query.
	 * The array can be empty if no object can be found.
	 * 
	 * @see		Query
	 * 
	 * @param	Query	$query		Query that you want to execute
	 * 
	 * @return	array	Array of objects matching the query
	 */
	public function find(Query $query);
	
	/**
	 * Create a new query
	 * 
	 * Return a new {@link FluentQuery} instance to play with for retrieving objects from the repository.
	 * 
	 * There are other solutions to create a {@link Query} instance.
	 * @todo	Make a comment about other solutions to create query...
	 * 
	 * @param	string		$class			The class of objects you want to query
	 * 
	 * @return	Query		A new query
	 */
	public function createQuery($class);
}