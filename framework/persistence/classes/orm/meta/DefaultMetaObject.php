<?php

namespace spiral\framework\persistence\orm\meta;

/**
 * Default meta object implementation
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
	 * @param	array	$attributes		Associative array of all attributes names and values
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
	 * @return	void
	 */
	public function setClass($class)
	{
		$this->_class = $class;
	}
}