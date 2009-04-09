<?php

/**
 * View
 * 
 * This component is a template for data representation.
 * It defines how the content will be rendered but not the content in itself.  
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface View
{
	/**
	 * Render the HTTP response
	 * 
	 * Put the data in the view and render the corresponding HTTP response.
	 *
	 * @param	Collection			$data		Data
	 * @return	HttpResponse
	 */
	public function render(Collection $data);
}

?>