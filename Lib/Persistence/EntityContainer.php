<?php

/**
 * Entity container
 * 
 * Generic container for all entities.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface EntityContainer
{
	/**
	 * Create a new entity
	 *
	 * @return	mixed
	 */
	public function create();
	
	/**
	 * Delete an entity
	 *
	 * @param	mixed	$id
	 * @return	void
	 */
	public function delete($id);
	
	/**
	 * Find all entities
	 * 
	 * Return all entities in an array.
	 *
	 * @return	array
	 */
	public function findAll();
	
	/**
	 * Find an entity by its id
	 * 
	 * Return an entity.
	 *
	 * @param	mixed	$id
	 * @return	mixed
	 */
	public function findById($id);
	
	/**
	 * Save an entity
	 *
	 * @param	mixed	$entity
	 * @return	void
	 */
	public function save($entity);
}

?>