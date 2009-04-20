<?php

/**
 * Default implementation of Constraints interface
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Constraints_Default extends CriteriaContainer_Default implements Constraints
{
	/**
	 * Entity type
	 *
	 * @var	string
	 */
	private $_entityType = null;
	
	/**
	 * Limit
	 *
	 * Default value is no limit.
	 * 
	 * @var	int
	 */
	private $_limit = -1;
	
	/**
	 * Offset
	 *
	 * Default is first index.
	 * 
	 * @var	int
	 */
	private $_offset = 0;
	
	/**
	 * Order constraints
	 *
	 * Array that contains order constraints as following :
	 * array(array('attribute'=>'date', 'order'=>Constraints::DESC),
	 * 		array('attribute'=>'title', 'order'=>Constraints::ASC));
	 * 
	 * @var	array
	 */
	private $_orderConstraints = array();
	
	/**
	 * Constructor
	 *
	 * @param	string	$entityType
	 */
	public function __construct($entityType)
	{
		parent::__construct();
		$this->setEntityType($entityType);
	}
	
	/**
	 * Add an order constraint
	 *
	 * The order value must be one of the Constraints interface order constant.
	 * Default order is Constraints::ASC.
	 * 
	 * @param	string		$attribute
	 * @param	int			$order
	 * 
	 * @return 	void
	 */
	public function addOrderConstraint($attribute, $order = Constraints::ASC)
	{
		// Check type of parameters
		assert('is_string($attribute)');
		assert('$order == Constraints::ASC ||
				$order == Constraints::DESC');
		
		$this->_orderConstraints[] = array('attribute'=>$attribute, 'order'=>$order);
	}
	
	/**
	 * Return the entity type
	 *
	 * The entity type is used to identify which entities are concerned in the result.
	 * 
	 * @return	string
	 */
	public function getEntityType()
	{
		return $this->_entityType;
	}
	
	/**
	 * Return limit value
	 *
	 * The limit value is the number of elements after the element corresponding to offset.
	 * A negative value means no limit.
	 *  
	 * @return	int
	 */
	public function getLimit()
	{
		return $this->_limit;
	}
	
	/**
	 * Return offset value
	 *
	 * The offset value is the index of the first element selected.
	 * 0 is the first index.
	 * 
	 * @return	int
	 */
	public function getOffset()
	{
		return $this->_offset;
	}
	
	/**
	 * Return order constraints
	 *
	 * Constraints are returned in an array like this :
	 * array(array('attribute'=>'date', 'order'=>Constraints::DESC),
	 * 		array('attribute'=>'title', 'order'=>Constraints::ASC));
	 * 
	 * Orders are Constraints interface order constants.
	 * 
	 * @return	array
	 */
	public function getOrderConstraints()
	{
		return $this->_orderConstraints;
	}
	
	/**
	 * Set the entity type
	 *
	 * The entity type is used to identify which entities are concerned in the result.
	 * 
	 * @param	string		$entityType
	 * 
	 * @return 	void
	 */
	public function setEntityType($entityType)
	{
		// Check type of parameters
		assert('is_string($entityType)');
		
		$this->_entityType = $entityType;
	}
	
	/**
	 * Set limit value
	 * 
	 * The limit value is the number of elements after the element corresponding to offset.
	 * A negative value means no limit.
	 *
	 * @param	int			$limit
	 * 
	 * @return 	void
	 */
	public function setLimit($limit)
	{
		// Check type of parameters
		assert('is_int($limit)');
		
		$this->_limit = $limit;
	}
	
	/**
	 * Set offset value
	 * 
	 * The offset value is the index of the first element selected.
	 * This value must be positive.
	 * 0 is the first index.
	 *
	 * @param	int			$offset
	 * 
	 * @return 	void
	 */
	public function setOffset($offset)
	{
		// Check type of parameters
		assert('is_int($offset)');
		assert('$offset >= 0');
		
		$this->_offset = $offset;
	}
	
	/**
	 * Set order constraints
	 *
	 * Constraints must be given in an array like this :
	 * array(array('attribute'=>'date', 'order'=>Constraints::DESC),
	 * 		array('attribute'=>'title', 'order'=>Constraints::ASC));
	 * 
	 * Orders must be Constraints interface order constants.
	 * 
	 * @param	array	$orderConstraints
	 * 
	 * @return	void
	 */
	public function setOrderConstraints(array $orderConstraints)
	{
		$this->_orderConstraints = $orderConstraints;
	}
	
	/**
	 * Set range of concerned elements
	 * 
	 * The offset value is the index of the first element selected.
	 * The limit value is the number of elements after the element corresponding to offset.
	 *
	 * @param	int			$offset
	 * @param	int			$limit
	 * 
	 * @return 	void
	 */
	public function setRange($offset, $limit)
	{
		$this->setOffset($offset);
		$this->setLimit($limit);
	}
}

?>