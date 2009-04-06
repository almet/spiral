<?php

/**
 * HTTP response to the client
 * 
 * This is the component that represents the system HTTP response to the client HTTP request.
 * It provides a simple interface to write HTTP response.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface HttpResponse
{
	/**
	 * Add content at the end of the existing one
	 *
	 * @param	string	$content	Content
	 * @return	void
	 */
	public function addContent($content);
	
	/**
	 * Add a header
	 *
	 * @param	string	$header		Header
	 * @return	void
	 */
	public function addHeader($header);
	
	/**
	 * Get the content
	 *
	 * @return	string
	 */
	public function getContent();
	
	/**
	 * Send the response to the client
	 *
	 * @return	void
	 */
	public function send();
	
	/**
	 * Set the content
	 *
	 * @param	string	$content	Content
	 * @return	void
	 */
	public function setContent($content);
}

?>