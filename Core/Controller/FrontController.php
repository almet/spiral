<?php

/**
 * Front controller of the system
 * 
 * The role of this component is to manage the HTTP communication.
 * Typically, it receives an HTTP request and dispatch roles to other components.
 * His role is to give back an HTTP response to his caller.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface FrontController
{
	/**
	 * Run the controller job
	 *
	 * @param	HttpRequest			$httpRequest		HTTP request
	 * @return	HttpResponse
	 */
	public function run(HttpRequest $httpRequest);
}

?>