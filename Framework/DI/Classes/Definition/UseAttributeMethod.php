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
class UseAttributeMethod extends DefaultMethod
{		
    /**
	 * construct a method and set it's name
	 *
	 * @param	string	$methodName
	 * @param	string	$className
	 */
	public function __construct($methodName, $className=null)
	{
		$this->setName($methodName);
		if ($className != null)
		{
			$this->setClassName($className);
		}
	}
}
?>
