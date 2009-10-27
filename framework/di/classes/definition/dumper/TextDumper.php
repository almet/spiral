<?php

namespace spiral\framework\di\definition\dumper;

use \spiral\framework\di\definition\ActiveServiceArgument;
use \spiral\framework\di\definition\ServiceReferenceArgument;

/**
 * This specific dumper convert a schema object into text.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class TextDumper extends AbstractDumper
{
	/**
	 * Convert the schema object into text string
	 * 
	 * @return 	string
	 */
	public function dump()
	{
		$output = '';
		foreach($this->_schema as $service)
		{
			$output .= '['.$service->getName()."]\n";
			foreach($service as $method)
			{
				$output .= '-> call ';
				
				if ($method->isStatic())
				{
					$output .= $method->getClass().'::';
				} 
				$output .= $method->getName()." with: \n";
				
				foreach($method as $argument)
				{
					$output .= "\t - ";

					if ($argument instanceof ActiveServiceArgument)
					{
						$output .= '['.$service->getName().']';
					}
					elseif($argument instanceof ServiceReferenceArgument)
					{
						$output .= '['.$argument->getValue().']';
					} 
					else 
					{
						$output .= $argument->getValue();
					}
					$output .= "\n";
				}
				$output .= "\n";
			}
		}
		return $output;
	}
}
