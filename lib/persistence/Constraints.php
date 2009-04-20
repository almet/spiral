<?php

/**
 * Constraints
 * 
 * Constraints used to communicate with data mapper.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface Constraints extends CriteriaContainer
{
	/**
	 * Ascendent order sort
	 *
	 * @var	int
	 */
	const ASC = 0;
	
	/**
	 * Descendent order sort
	 *
	 * @var	int
	 */
	const DESC = 1;
	
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
	public function addOrderConstraint($attribute, $order = Constraints::ASC);
	
	/**
	 * Return the entity type
	 *
	 * The entity type is used to identify which entities are concerned in the result.
	 * 
	 * @return	string
	 */
	public function getEntityType();
	
	/**
	 * Return limit value
	 *
	 * The limit value is the number of elements after the element corresponding to offset.
	 * A negative value means no limit.
	 * 
	 * @return	int
	 */
	public function getLimit();
	
	/**
	 * Return offset value
	 *
	 * The offset value is the index of the first element selected.
	 * 0 is the first index.
	 * 
	 * @return	int
	 */
	public function getOffset();
	
	/**
	 * Return order constraints
	 *
	 * Order constraints are returned in an array like this :
	 * array(array('attribute'=>'date', 'order'=>Constraints::DESC),
	 * 		array('attribute'=>'title', 'order'=>Constraints::ASC));
	 * 
	 * Orders are Constraints interface order constants.
	 * 
	 * @return	array
	 */
	public function getOrderConstraints();
	
	/**
	 * Set the entity type
	 *
	 * The entity type is used to identify which entities are concerned in the result.
	 * 
	 * @param	string		$entityType
	 * 
	 * @return 	void
	 */
	public function setEntityType($entityType);
	
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
	public function setLimit($limit);
	
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
	public function setOffset($offset);
	
	/**
	 * Set order constraints
	 *
	 * Order constraints must be given in an array like this :
	 * array(array('attribute'=>'date', 'order'=>Constraints::DESC),
	 * 		array('attribute'=>'title', 'order'=>Constraints::ASC));
	 * 
	 * Orders must be Constraints interface order constants.
	 * 
	 * @param	array	$orderConstraints
	 * 
	 * @return	void
	 */
	public function setOrderConstraints(array $orderConstraints);
	
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
	public function setRange($offset, $limit);
}

?>