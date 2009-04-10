<?php

/**
 * Data mapper for database connection
 * 
 * This component uses a DbConnection object to map data to a database.
 * 
 * Because of many SQL dialects, a SqlHelper object is used to generate SQL code.
 * This SqlHelper object should have the same SQL dialect as the DbConnection object.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class DataMapper_DbConnection extends DataMapper_Base
{
	/**
	 * Database connection
	 *
	 * @var	DbConnection
	 */
	private $_dbConnection = null;
	
	/**
	 * Database fields resolver
	 *
	 * @var	DbFieldsResolver
	 */
	private $_dbFieldsResolver = null;
	
	/**
	 * Database tables resolver
	 *
	 * @var	DbTablesResolver
	 */
	private $_dbTablesResolver = null;
	
	/**
	 * Entity attributes values resolver
	 *
	 * @var	EntityIdResolver
	 */
	private $_entityAttributesValuesResolver = null;
	
	/**
	 * Entity id resolver
	 *
	 * @var	EntityIdResolver
	 */
	private $_entityIdResolver = null;
	
	/**
	 * Entity persistent attributes resolver
	 *
	 * @var	EntityPersistentAttributesResolver
	 */
	private $_entityPersistentAttributesResolver = null;
	
	/**
	 * SQL helper
	 *
	 * @var	SqlHelper
	 */
	private $_sqlHelper = null;
	
	/**
	 * Prepare database constraints from entity constraints
	 *
	 * @param	Constraints		$constraints
	 * @param	array			$dbTables
	 * @param	array			$dbFields
	 * 
	 * @return	DbConstraints
	 * 
	 * @todo 	Check code
	 */
	private function _prepareDbConstraints(Constraints $constraints, array $dbTables, array $dbFields)
	{
		$dbConstraints = new DbConstraints_Default('none');
		
		$dbConstraints->setTables($dbTables);
		$dbConstraints->setRange($constraints->getOffset(), $constraints->getLimit());

		$newOrderConstraints = array();
		$orderConstraints = $constraints->getOrderConstraints();
		foreach($orderConstraints as $c)
		{
			$newOrderConstraints[] = array('attribute'=>$dbFields[$c['attribute']], 'order'=>$c['order']);
		}
		$dbConstraints->setOrderConstraints($newOrderConstraints);
		
		$criterias = $constraints->getCriterias();
		foreach($criterias as $c)
		{
			$dbConstraints->addCriteria(clone $c);
		}
		
		$criteriaContainers = $constraints->getContainers();
		foreach($criteriaContainers as $c)
		{
			$dbConstraints->addContainer(clone $c);
		}
		
		$this->_prepareDbCriterias($dbConstraints, $dbFields);
		
		return $dbConstraints;
	}
	
	/**
	 * Update fields in a criteria container
	 *
	 * @param	CriteriaContainer		$container
	 * @param	array					$dbFields
	 * 
	 * @return	void
	 * 
	 * @todo 	Check code
	 */
	private function _prepareDbCriterias(CriteriaContainer $container, array $dbFields)
	{
		// Prepare criterias
		$criterias = $container->getCriterias();
		
		foreach($criterias as $c)
		{
			$attribute = $c->getAttribute();
			$c->setAttribute($dbFields[$attribute]);
		}
		
		// Recursively prepare sub-containers
		$containers = $container->getContainers();
		
		foreach($containers as $c)
		{
			$this->_prepareDbCriterias($c, $dbFields);
		}
	}
	
	/**
	 * Prepare internal parameters keys
	 *
	 * @param	array			$parameters
	 * 
	 * @return	void
	 * 
	 * @todo 	Check code
	 */
	private function _prepareInternalParametersKeys(array $parameters)
	{
		$return = array();
		
		foreach($parameters as $key=>$value)
		{
			$return['_'.$key] = $value;
		}
		
		return $return;
	}
	
	/**
	 * Add an entity in the persistence source
	 *
	 * The value of id attribute will be set if automatic value is used.
	 * Otherwise, it must be set before calling this method.
	 * 
	 * @param		string		$entityType
	 * @param		object		$entity
	 * 
	 * @pre			The entity attributes values resolver is well defined
	 * @pre			The database connection is well defined
	 * @pre			The database tables resolver is well defined
	 * @pre			The database fields resolver is well defined
	 * @pre			The entity id resolver is well defined
	 * @pre			The entity persistent attributes resolver is well defined
	 * @pre			The SQL helper is well defined
	 * 
	 * @post		The entity id attribute is not null
	 * 
	 * @return		void
	 */
	public function add($entityType, $entity)
	{
		// Check type of parameters
		assert('is_string($entityType)');
		assert('is_object($entity)');

		// Get entity informations
		assert('$this->getEntityPersistentAttributesResolver() instanceof EntityPersistentAttributesResolver');
		$persistentAttributes = $this->getEntityPersistentAttributesResolver()->resolveEntityPersistentAttributes($entityType);

		// Get database informations on this entity
		assert('$this->getDbTablesResolver() instanceof DbTablesResolver');
		$dbTables = $this->getDbTablesResolver()->resolveDbTables($entityType);
		assert('$this->getDbFieldsResolver() instanceof DbFieldsResolver');
		$dbFields = $this->getDbFieldsResolver()->resolveDbFields($entityType, $persistentAttributes);
		
		// Prepare values as parameters for the query
		assert('$this->getEntityAttributesValuesResolver() instanceof EntityAttributesValuesResolver');
		$attributesValues = $this->getEntityAttributesValuesResolver()->resolveEntityAttributesValues($entityType, $entity, $persistentAttributes);
		$queryParameters = $this->_prepareInternalParametersKeys($attributesValues);

		// Prepare the SQL query
		$preparedDbFields = $this->_prepareInternalParametersKeys($dbFields);
		assert('$this->getSqlHelper() instanceof SqlHelper');
		$sqlQuery = $this->getSqlHelper()->buildInsert($dbTables, $preparedDbFields);

		// Send the SQL query
		assert('$this->getDbConnection() instanceof DbConnection');
		$this->getDbConnection()->query($sqlQuery, $queryParameters);
		
		// TODO : Check if automatic id or not
		assert('$this->getEntityIdResolver() instanceof EntityIdResolver');
		$entityId = $this->getEntityIdResolver()->resolveEntityId($entityType);
		assert('$this->getDbConnection() instanceof DbConnection');
		$entity->$entityId = $this->getDbConnection()->getLastInsertedId();
		
		// Postcondition : The entity id attribute is not null
		assert('!empty($entity->$entityId)');
	}
	
	/**
	 * Delete entities that match the constraints
	 * 
	 * Delete all entities, from persistence source, that match the constraints.
	 * If the constraints need parameter values, they must be given.
	 *
	 * @param	Constraints		$constraints
	 * @param	array			$constraintsParameters
	 * 
	 * @pre		The entity persistent attributes resolver is well defined
	 * @pre		The database tables resolver is well defined
	 * @pre		The database fields resolver is well defined
	 * @pre		The SQL helper is well defined
	 * @pre		The database connection is well defined
	 * 
	 * @return	void
	 */
	public function delete(Constraints $constraints, array $constraintsParameters = null)
	{
		// Get entity informations
		$entityType = $constraints->getEntityType();
		assert('$this->getEntityPersistentAttributesResolver() instanceof EntityPersistentAttributesResolver');
		$persistentAttributes = $this->getEntityPersistentAttributesResolver()->resolveEntityPersistentAttributes($entityType);
		
		// Get database informations for this entity
		assert('$this->getDbTablesResolver() instanceof DbTablesResolver');
		$dbTables = $this->getDbTablesResolver()->resolveDbTables($entityType);
		assert('$this->getDbFieldsResolver() instanceof DbFieldsResolver');
		$dbFields = $this->getDbFieldsResolver()->resolveDbFields($entityType, $persistentAttributes);
		
		// Prepare SQL query
		$dbConstraints = $this->_prepareDbConstraints($constraints, $dbTables, $dbFields);
		assert('$this->getSqlHelper() instanceof SqlHelper');
		$sqlQuery = $this->getSqlHelper()->buildDelete($dbConstraints);
		
		// Send query
		assert('$this->getDbConnection() instanceof DbConnection');
		$this->getDbConnection()->query($sqlQuery, $constraintsParameters);
	}
	
	/**
	 * Return all entities that match the constraints
	 *
	 * Retrieve all entities, from persistence source, that match the constraints.
	 * If the constraints need parameter values, they must be given.
	 * 
	 * @param	Constraints		$constraints
	 * @param	array			$constraintsParameters
	 * 
	 * @pre		The entity persistent attributes resolver is well defined
	 * @pre		The database tables resolver is well defined
	 * @pre		The database fields resolver is well defined
	 * @pre		The SQL helper is well defined
	 * @pre		The database connection is well defined
	 * 
	 * @return	array
	 */
	public function get(Constraints $constraints, array $constraintsParameters = null)
	{
		// Get informations on the entity
		$entityType = $constraints->getEntityType();
		assert('$this->getEntityPersistentAttributesResolver() instanceof EntityPersistentAttributesResolver');
		$persistentAttributes = $this->getEntityPersistentAttributesResolver()->resolveEntityPersistentAttributes($entityType);
		
		// Get database informations for this entity
		assert('$this->getDbTablesResolver() instanceof DbTablesResolver');
		$dbTables = $this->getDbTablesResolver()->resolveDbTables($entityType);
		assert('$this->getDbFieldsResolver() instanceof DbFieldsResolver');
		$dbFields = $this->getDbFieldsResolver()->resolveDbFields($entityType, $persistentAttributes);
		
		// Prepare SQL query
		$dbConstraints = $this->_prepareDbConstraints($constraints, $dbTables, $dbFields);
		assert('$this->getSqlHelper() instanceof SqlHelper');
		$sqlQuery = $this->getSqlHelper()->buildSelect($dbConstraints);
		
		// Send the SQL query
		// TODO : Transform the array in an array of entities
		assert('$this->getDbConnection() instanceof DbConnection');
		return $this->getDbConnection()->query($sqlQuery, $constraintsParameters);
	}
	
	/**
	 * Return the database connection
	 * 
	 * @return	DbConnection
	 */
	public function getDbConnection()
	{
		return $this->_dbConnection;
	}
	
	/**
	 * Return the database fields resolver
	 * 
	 * @return	DbFieldsResolver
	 */
	public function getDbFieldsResolver()
	{
		return $this->_dbFieldsResolver;
	}
	
	/**
	 * Return the database tables resolver
	 * 
	 * @return	DbTablesResolver
	 */
	public function getDbTablesResolver()
	{
		return $this->_dbTablesResolver;
	}
	
	/**
	 * Return the entity attributes values resolver
	 * 
	 * @return	EntityAttributesValuesResolver
	 */
	public function getEntityAttributesValuesResolver()
	{
		return $this->_entityAttributesValuesResolver;
	}
	
	/**
	 * Return the entity id resolver
	 * 
	 * @return	EntityIdResolver
	 */
	public function getEntityIdResolver()
	{
		return $this->_entityIdResolver;
	}
	
	/**
	 * Return the entity persistent attributes resolver
	 * 
	 * @return	EntityPersistentAttributesResolver
	 */
	public function getEntityPersistentAttributesResolver()
	{
		return $this->_entityPersistentAttributesResolver;
	}
	
	/**
	 * Return the SQL helper
	 * 
	 * @return	SqlHelper
	 */
	public function getSqlHelper()
	{
		return $this->_sqlHelper;
	}
	
	/**
	 * Set the database connection
	 * 
	 * @param 	DbConnection	$dbConnection
	 * 
	 * @return	void
	 */
	public function setDbConnection(DbConnection $dbConnection)
	{
		$this->_dbConnection = $dbConnection;
	}
	
	/**
	 * Set the database fields resolver
	 * 
	 * @param	DbFieldsResolver		$resolver
	 * 
	 * @return	void
	 */
	public function setDbFieldsResolver(DbFieldsResolver $resolver)
	{
		$this->_dbFieldsResolver = $resolver;
	}
	
	/**
	 * Set the database tables resolver
	 * 
	 * @param	DbTablesResolver		$resolver
	 * 
	 * @return	void
	 */
	public function setDbTablesResolver(DbTablesResolver $resolver)
	{
		$this->_dbTablesResolver = $resolver;
	}
	
	/**
	 * Set the entity attributes values resolver
	 * 
	 * @param	EntityAttributesValuesResolver	$resolver
	 * 
	 * @return	void
	 */
	public function setEntityAttributesValuesResolver(EntityAttributesValuesResolver $resolver)
	{
		$this->_entityAttributesValuesResolver = $resolver;
	}
	
	/**
	 * Set the entity id resolver
	 * 
	 * @param	EntityIdResolver	$resolver
	 * 
	 * @return	void
	 */
	public function setEntityIdResolver(EntityIdResolver $resolver)
	{
		$this->_entityIdResolver = $resolver;
	}
	
	/**
	 * Set the entity persistent attributes resolver
	 * 
	 * @param	EntityPersistentAttributesResolver	$resolver
	 * 
	 * @return	void
	 */
	public function setEntityPersistentAttributesResolver(EntityPersistentAttributesResolver $resolver)
	{
		$this->_entityPersistentAttributesResolver = $resolver;
	}
	
	/**
	 * Set the SQL helper
	 * 
	 * @param 	SqlHelper		$sqlHelper
	 * 
	 * @return	void
	 */
	public function setSqlHelper(SqlHelper $sqlHelper)
	{
		$this->_sqlHelper = $sqlHelper;
	}
	
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
	 * @pre		The database connection is well defined
	 * @pre		The database fields resolver is well defined
	 * @pre		The database tables resolver is well defined
	 * @pre		The entity persistent attributes resolver is well defined
	 * @pre		The SQL helper is well defined
	 * 
	 * @return	void
	 */
	public function update(Constraints $constraints, array $values, array $constraintsParameters = null)
	{
		// Get informations on the entity
		$entityType = $constraints->getEntityType();
		assert('$this->getEntityPersistentAttributesResolver() instanceof EntityPersistentAttributesResolver');
		$persistentAttributes = $this->getEntityPersistentAttributesResolver()->resolveEntityPersistentAttributes($entityType);
		
		// Prepare query parameters
		$attributesValues = array_intersect_key($values, array_flip($persistentAttributes));
		$internalParameters = $this->_prepareInternalParametersKeys($attributesValues);
		
		if(!empty($constraintsParameters))
		{
			$queryParameters = array_merge($internalParameters, $constraintsParameters);
		}
		else
		{
			$queryParameters = $internalParameters;
		}
		
		// Get database informations for the entity
		assert('$this->getDbTablesResolver() instanceof DbTablesResolver');
		$dbTables = $this->getDbTablesResolver()->resolveDbTables($entityType);
		assert('$this->getDbFieldsResolver() instanceof DbFieldsResolver');
		$dbFields = $this->getDbFieldsResolver()->resolveDbFields($entityType, $persistentAttributes);
		
		// Prepare SQL query
		$dbFieldsFiltered = array_intersect_key($dbFields, $values);
		$preparedDbFields = $this->_prepareInternalParametersKeys($dbFieldsFiltered);
		$dbConstraints = $this->_prepareDbConstraints($constraints, $dbTables, $dbFields);
		assert('$this->getSqlHelper() instanceof SqlHelper');
		$sqlQuery = $this->getSqlHelper()->buildUpdate($dbConstraints, $preparedDbFields);
		
		// Send the SQL query
		assert('$this->getDbConnection() instanceof DbConnection');
		$this->getDbConnection()->query($sqlQuery, $queryParameters);
	}
}

?>