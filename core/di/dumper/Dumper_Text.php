<?php
namespace spiral\core\di\dumper;

/**
 * This specific dumper convert a schema object into text.
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class Dumper_Text extends Dumper_Abstract
{

	/**
	 * convert the schema object into text string
	 *
	 * @param	Schema	$schema		The schema object to dump
	 * @param	array 	$parameters	Some useful parameters
	 * @return 	string
	 */
	 
	public function dump()
	{
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
				
				foreach($method as $arg)
				{
					$output .= "\t - ";

					if ($arg[0] == 'SPIRAL_DI_ACTIVE_SERVICE' && $arg[1] == 'ARG_IS_SERVICE')
					{
						$output .= '['.$service->getName().']';
					} elseif($arg[1] == 'ARG_IS_SERVICE')
					{
						$output .= '['.$arg[0].']';
					} else 
					{
						$output .= $arg[0];
					}
					$output .= "\n";
				}
				$output .= "\n";
			}
		}
		return $output;
	}
}
?>
