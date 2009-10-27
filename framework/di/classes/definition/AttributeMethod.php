<?php

namespace spiral\framework\di\definition;

/**
 * A method that contains attribute.
 *
 * It's like calling $obj->$attribute = $value
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class AttributeMethod extends DefaultMethod
{
	public function __construct($attribute, $value)
	{
		$this->setName($attribute);
		$this->addArgument($value);
	}
	
}
