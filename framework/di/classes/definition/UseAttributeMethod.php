<?php

namespace spiral\framework\di\definition;

/**
 * Default implementation of Method
 *
 * See the interface for further information.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class UseAttributeMethod extends DefaultMethod
{
    /**
	 * Construct a method and set it's name
	 *
	 * @param	string	$methodName
	 * @param	string	$className
	 * @return	void
	 */
	public function __construct($methodName, $className=null)
	{
		$this->setName($methodName);
		if($className != null)
		{
			$this->setClassName($className);
		}
	}
}
