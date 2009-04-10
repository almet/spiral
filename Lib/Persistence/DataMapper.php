<?php

/**
 * Data mapper
 * 
 * This component realizes mapping between objects and their persistent representation.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface DataMapper
{
	/**
	 * Add an entity in the persistence source
	 *
	 * The value of id attribute will be set if automatic value is used.
	 * Otherwise, it must be set before calling this method.
	 * 
	 * @param		string		$entityType
	 * @param		object		$entity
	 * 
	 * @post		The entity id attribute is not null
	 * 
	 * @return		void
	 */
	public function add($entityType, $entity);
	
	/**
	 * Delete entities that match the constraints
	 * 
	 * Delete all entities, from persistence source, that match the constraints.
	 * If the constraints need parameter values, they must be given.
	 *
	 * @param	Constraints		$constraints
	 * @param	array			$constraintsParameters
	 * 
	 * @return	void
	 */
	public function delete(Constraints $constraints, array $constraintsParameters = null);
	
	/**
	 * Return all entities that match the constraints
	 *
	 * Retrieve all entities, from persistence source, that match the constraints.
	 * If the constraints need parameter values, they must be given.
	 * 
	 * @param	Constraints		$constraints
	 * @param	array			$constraintsParameters
	 * 
	 * @return	array
	 */
	public function get(Constraints $constraints, array $constraintsParameters = null);
	
	/**
	 * Update all entities that match the constraints
	 *
	 * Update all entities in the persistence source that match the given constraints.
	 * If the constraints need parameter values, they must be given.
	 * 
	 * $values is an associative array with field names as keys and corresponding new values as values.
	 * 
	 * Ex: array('title'=>'Le bourgeois gentilhomme', 'author'=>'Molière');
	 *
	 * @param	Constraints		$constraints
	 * @param	array			$values
	 * @param	array			$constraintsParameters
	 * 
	 * @return	void
	 */
	public function update(Constraints $constraints, array $values, array $constraintsParameters = null);
}

?>