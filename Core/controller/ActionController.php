<?php

/**
 * Action controller
 * 
 * This component answers to a specific HTTP request.
 * Generally, his job consists in getting informations from the model and defining the view to use.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface ActionController
{
	/**
	 * Run the controller job
	 *
	 * @param	HttpRequest			$httpRequest		HTTP request
	 * @return	ActionResponse
	 */
	public function run(HttpRequest $httpRequest);
}

?>