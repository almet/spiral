<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * A method that contains attribute.
 *
 * it's like calling $obj->$attribute = $value
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class AttributeMethod extends DefaultMethod
{
	public function __construct($attribute, $value){
		$this->setName($attribute);
		$this->addArgument($value);
	}
	
}
?>
