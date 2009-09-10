<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class AttributeMethod extends DefaultMethod
{
	/**
	 * Attribute name
	 * 
	 * @var string
	 */	
	protected $_attribute = null;
	
	/**
	 * Attribute value
	 * 
	 * @var string
	 */
	protected $_value = null;
	
    /**
	 * construct a method and set it's name
	 *
	 * @param	string	$methodName
	 * @param	string	$className
	 */
	public function __construct($attribute, $value)
	{
		 $this->_attribute = $attribute;
		 $this->_value = $value;
	}
	
	/**
	 * return the attribute name
	 * 
	 * @return string
	 */
	public function getAttribute(){
		return $this->_attribute;
	}
	
	/**
	 * return the value
	 * 
	 * @return string
	 */
	public function getValue(){
		return $this->_value;
	}
}
?>
