<?php

/**
 * Basic implementation of DataMapper interface
 * 
 * This should be extended by all DataMapper implementations.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
abstract class DataMapper_Base implements DataMapper
{
	/**
	 * Entity prototype resolver
	 *
	 * @var		EntityPrototypeResolver
	 */
	private $_entityPrototypeResolver = null;
	
	/**
	 * Create a new entity
	 *
	 * Create a new entity that correspond to given entity type.
	 * This entity is not yet persistent and does not exist in the persistence source.
	 * 
	 * @param		string		$entityType
	 * 
	 * @pre			The entity prototype resolver is well defined
	 * 
	 * @return		object
	 */
	public function create($entityType)
	{
		// Check type of parameters
		assert('is_string($entityType)');
		
		// Get prototype
		assert('$this->getEntityPrototypeResolver() instanceof EntityPrototypeResolver');
		$prototype = $this->getEntityPrototypeResolver()->resolveEntityPrototype($entityType);
		
		// Return a clone of the prototype
		return clone $prototype;
	}
	
	/**
	 * Return the entity prototype resolver
	 *
	 * @return	EntityPrototypeResolver
	 */
	public function getEntityPrototypeResolver()
	{
		return $this->_entityPrototypeResolver;
	}
	
	/**
	 * Set the entity prototype resolver
	 *
	 * @param	EntityPrototypeResolver		$resolver
	 * 
	 * @return	void
	 */
	public function setEntityPrototypeResolver(EntityPrototypeResolver $resolver)
	{
		$this->_entityPrototypeResolver = $resolver;
	}
}

?>