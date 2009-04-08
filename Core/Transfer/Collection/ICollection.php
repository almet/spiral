<?php
namespace Spiral\Core\Transfer\Collection;

/**
 * Collection of elements
 *
 * This is a collection where you can put elements and retrieve them.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface ICollection
{
	/**
	 * Getter
	 *
	 * Alias of getElement
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function __get($name);
	
	/**
	 * Isset
	 *
	 * Alias of hasElement
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function __isset($name);
	
	/**
	 * Setter
	 *
	 * Alias of setElement
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function __set($name, $value);
	
	/**
	 * Unset
	 *
	 * Alias of removeElement
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function __unset($name);
	
	/**
	 * Return an element value
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function getElement($name);
	
	/**
	 * Return all elements
	 *
	 * @return	array
	 */
	public function getElements();
	
	/**
	 * Return if an element exists
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function hasElement($name);
	
	/**
	 * Remove an element
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function removeElement($name);
	
	/**
	 * Set an element value
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function setElement($name, $value);
	
	/**
	 * Set the values of multiple elements
	 *
	 * @param	array	$elements	Elements
	 * @return	void
	 */
	public function setElements($elements);
}

?>
