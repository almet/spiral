<?php
namespace Spiral\Core\Transfer\Collection;
/**
 * Default implementation of an elements collection
 *
 * @package		spiral
 * @subpackage	core.utils
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @contributor Alexis Metaireau <ametaireau@gmail.com>
 */
class Base implements Collection
{
	/**
	 * Elements of the collection
	 *
	 * @var	array
	 */
	private $_elements = array();

	/**
	 * Constructor
	 *
	 * @param	array	$elements	Elements to add at the creation
	 * @return	void
	 * 
	 * @todo	Filter elements
	 */
	public function __construct($elements = array())
	{
		$this->_elements = $elements;
	}
	
	/**
	 * Getter
	 *
	 * Alias of getElement
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function __get($name)
	{
		return $this->getElement($name);
	}
	
	/**
	 * Isset
	 *
	 * Alias of hasElement
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function __isset($name)
	{
		return $this->hasElement($name);
	}
	
	/**
	 * Setter
	 *
	 * Alias of setElement
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function __set($name, $value)
	{
		$this->setElement($name, $value);
	}
	
	/**
	 * Unset
	 *
	 * Alias of removeElement
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function __unset($name)
	{
		$this->removeElement($name);
	}
	
	/**
	 * Return element value
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function getElement($name)
	{
		if(!$this->hasElement($name))
			return null;

		return $this->_elements[$name];
	}
	
	/**
	 * Return elements
	 *
	 * @return	array
	 */
	public function getElements()
	{
		return $this->_elements;
	}
	
	/**
	 * Return if element exists
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function hasElement($name)
	{
		return isset($this->_elements[$name]);
	}
	
	/**
	 * Remove an element
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function removeElement($name)
	{
		unset($this->_elements[$name]);
	}
	
	/**
	 * Set element value
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function setElement($name, $value)
	{
		$this->_elements[$name] = $value;
	}
	
	/**
	 * Sets the values of multiple elements
	 *
	 * @param	array	$elements	Elements
	 * @return	void
	 */
	public function setElements($elements)
	{
		$this->_elements = array_merge($this->_elements, $elements);
	}
}

?>
