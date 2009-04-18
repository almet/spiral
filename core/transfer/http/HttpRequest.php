<?php

/**
 * HTTP request from the client
 * 
 * This is the component that represents the HTTP request from the client to the system.
 * It provides a simple interface to read an HTTP request.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface HttpRequest
{
	/**
	 * Return a parameter value
	 *
	 * @param	string	$name	Parameter name
	 * @return	mixed
	 */
	public function getParam($name);
}

?>