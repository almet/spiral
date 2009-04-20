<?php

/**
 * Criteria container
 * 
 * Contains multiple criterias.
 * Criteria containers can have two types : AND or OR to delimit its criterias.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface CriteriaContainer
{
	/**
	 * AND type
	 *
	 * Separate criterias by a logical AND.
	 * 
	 * @var	int
	 */
	const TYPE_AND = 0;
	
	/**
	 * OR type
	 *
	 * Separate criterias by a logical OR.
	 * 
	 * @var	int
	 */
	const TYPE_OR = 1;
	
	/**
	 * Add a criteria container
	 *
	 * @param	CriteriaContainer	$container
	 * 
	 * @return	void
	 */
	public function addContainer(CriteriaContainer $container);
	
	/**
	 * Add a criteria
	 *
	 * @param	Criteria	$criteria
	 * 
	 * @return 	void
	 */
	public function addCriteria(Criteria $criteria);
	
	/**
	 * Return all sub containers in an array
	 *
	 * @return	array
	 */
	public function getContainers();
	
	/**
	 * Return all criterias in an array
	 *
	 * @return	array
	 */
	public function getCriterias();
	
	/**
	 * Return the type of the container
	 *
	 * @return	int
	 */
	public function getType();
	
	/**
	 * Set all sub containers
	 *
	 * @param	array	$containers
	 * 
	 * @return 	void
	 */
	public function setContainers(array $containers);
	
	/**
	 * Set all criterias
	 * 
	 * @param 	array	$criterias
	 *
	 * @return 	void
	 */
	public function setCriterias(array $criterias);
	
	/**
	 * Set the type of the container
	 * 
	 * @param 	int		$type
	 * 
	 * @return 	void
	 */
	public function setType($type);
}

?>