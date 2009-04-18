<?php

/**
 * Default entity container
 * 
 * Default implementation of interface EntityContainer.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
abstract class EntityContainer_Default implements EntityContainer
{
	/**
	 * Entity interface
	 * 
	 * Should be defined in all subclasses.
	 *
	 * @var	string
	 */
	protected $_entityInterface = null;
	
	/**
	 * Persistence driver
	 *
	 * @var	PersistenceDriver
	 */
	private $_persistenceDriver = null;
	
	/**
	 * Constructor
	 *
	 * @param	PersistentDriver	$persistenceDriver
	 */
	public function __construct(PersistenceDriver $persistenceDriver)
	{
		$this->setPersistenceDriver($persistenceDriver);
	}
	
	/**
	 * Return the entity default class
	 * 
	 * @return	string
	 */
	private function _getEntityDefaultClass()
	{
		return $this->_getEntityInterface().'_Default';
	}
	
	/**
	 * Return the entity interface
	 * 
	 * @return	string
	 */
	private function _getEntityInterface()
	{
		// Check if entity interface is defined
		if(empty($this->_entityInterface))
		{
			throw new EntityContainerException_EmptyEntityInterface();
		}
	
		return $this->_entityInterface;
	}
	
	/**
	 * Create a new entity
	 *
	 * @return	mixed
	 */
	public function create()
	{
		$class = $this->_getEntityDefaultClass();
		return new $class();
	}
	
	/**
	 * Find an entity by its id
	 * 
	 * Return an entity.
	 *
	 * @param	mixed	$id
	 * @return	mixed
	 */
	public function findAll()
	{
		// TODO
	}
	
	/**
	 * Find an entity by its id
	 * 
	 * Return an entity.
	 *
	 * @param	mixed	$id
	 * @return	mixed
	 */
	public function findById($id)
	{
		// TODO
	}
	
	/**
	 * Return persistence driver
	 * 
	 * @return	PersistenceDriver
	 */
	public function getPersistenceDriver()
	{
		return $this->_persistenceDriver;
	}
	
	/**
	 * Save an entity
	 *
	 * @param	mixed	$entity
	 * @return	void
	 */
	public function save($entity)
	{
		// Check if the parameter implements the entity interface
		$entityInterface = $this->_getEntityInterface();
		if(!($entity instanceof $entityInterface))
		{
			throw new EntityContainerException_InvalidParameter($entity);
		}
	
		var_dump($entity);
	}
	
	/**
	 * Set persistence driver
	 * 
	 * @param	PersistenceDriver	$persistenceDriver
	 * @return	void
	 */
	public function setPersistenceDriver(PersistenceDriver $persistenceDriver)
	{
		$this->_persistenceDriver = $persistenceDriver;
	}
}

?>