<?php

/**
 * Default implementation of CriteriaContainer interface
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
class CriteriaContainer_Default implements CriteriaContainer
{
	/**
	 * Array of sub criteria containers
	 *
	 * @var	array
	 */
	private $_containers = array();
	
	/**
	 * Array of criterias
	 *
	 * @var	array
	 */
	private $_criterias = array();
	
	/**
	 * Container type
	 * 
	 * @var	int
	 */
	private $_type = null;
	
	/**
	 * Constructor
	 *
	 * Default type of container is TYPE_AND.
	 * 
	 * @param	int		 $type
	 * 
	 * @return 	void
	 */
	public function __construct($type = CriteriaContainer::TYPE_AND)
	{
		$this->setType($type);
	}
	
	/**
	 * Add a criteria container
	 *
	 * @param	CriteriaContainer	$container
	 * 
	 * @return	void
	 */
	public function addContainer(CriteriaContainer $container)
	{
		$this->_containers[] = $container;
	}
	
	/**
	 * Add a criteria
	 *
	 * @param	Criteria	$criteria
	 * 
	 * @return 	void
	 */
	public function addCriteria(Criteria $criteria)
	{
		$this->_criterias[] = $criteria;
	}
	
	/**
	 * Return all sub containers in an array
	 *
	 * @return	array
	 */
	public function getContainers()
	{
		return $this->_containers;
	}
	
	/**
	 * Return all criterias in an array
	 *
	 * @return	array
	 */
	public function getCriterias()
	{
		return $this->_criterias;
	}
	
	/**
	 * Return the type of the container
	 *
	 * @return	int
	 */
	public function getType()
	{
		return $this->_type;
	}
	
	/**
	 * Set all sub containers
	 *
	 * @param	array	$containers
	 * 
	 * @return 	void
	 */
	public function setContainers(array $containers)
	{
		$this->_containers = $containers;
	}
	
	/**
	 * Set all criterias
	 * 
	 * @param 	array	$criterias
	 *
	 * @return 	void
	 */
	public function setCriterias(array $criterias)
	{
		$this->_criterias = $criterias;
	}
	
	/**
	 * Set the type of the container
	 * 
	 * @param 	int		$type
	 * 
	 * @return 	void
	 */
	public function setType($type)
	{
		// Check type of parameters
		assert('$type == CriteriaContainer::TYPE_AND ||
				$type == CriteriaContainer::TYPE_OR');
		
		$this->_type = $type;
	}
}

?>