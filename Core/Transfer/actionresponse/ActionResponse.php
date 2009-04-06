<?php

/**
 * Response from an action
 * 
 * This component is used to communicate between the FrontController and ActionController.
 * It is a collection of multiple content elements.
 * It also provides the informations for view resolving.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface ActionResponse extends Collection
{
	/**
	 * Return the view name
	 *
	 * @return	string
	 */
	public function getViewName();
	
	/**
	 * Set the view name
	 *
	 * @param	string	$viewName	View name
	 * @return	void
	 */
	public function setViewName($viewName);
}

?>