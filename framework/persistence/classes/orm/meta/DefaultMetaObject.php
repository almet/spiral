<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Default meta object implementation
 * 
 * @see			MetaObject
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class DefaultMetaObject implements MetaObject
{
	/**
	 * Attributes
	 * 
	 * @var	array
	 */
	private $_attributes = array();
	
	/**
	 * Class
	 * 
	 * @var	string
	 */
	private $_class = null;
	
	/**
	 * Return attributes as an associative array
	 * 
	 * The array is empty if there are no attributes.
	 * 
	 * @return	array	Associative array of all attributes names and values
	 */
	public function getAttributes()
	{
		return $this->_attributes;
	}
	
	/**
	 * Return the instanciation class
	 * 
	 * @return	string	Full name of the class with namespace
	 */
	public function getClass()
	{
		return $this->_class;
	}
	
	/**
	 * Define attributes by an associative array
	 * 
	 * The array is empty if there are no attributes.
	 * 
	 * @param	array	$attributes		Associative array of all attributes names and values.
	 * 
	 * @return	void
	 */
	public function setAttributes(array $attributes)
	{
		$this->_attributes = $attributes;
	}
	
	/**
	 * Define the instanciation class
	 * 
	 * @param	string	Full name of the class with namespace
	 * 
	 * @return	void
	 */
	public function setClass($class)
	{
		$this->_class = $class;
	}
}