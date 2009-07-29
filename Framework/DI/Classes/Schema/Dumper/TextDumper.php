<?php
namespace Spiral\Framework\DI\Schema\Dumper;
use Spiral\Framework\DI\Schema\ServiceReferenceArgument;

/**
 * This specific dumper convert a schema object into text.
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class TextDumper extends AbstractDumper
{
	/**
	 * convert the schema object into text string
	 * 
	 * @return 	string
	 */
	public function dump()
	{
		$output ='';
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
?>
