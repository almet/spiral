<?php
namespace spiral\core\di\dumper;

/**
 * This specific dumper convert a schema object into a dot string.
 *
 * A dot file can be rendered by various programs into graphics.
 *
 * Thanks to Fabien Potencier for the idea of a dot dumper.
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class Dumper_Dot extends Dumper_Abstract{

	/**
	 * Default options for 
	 * generating graphics
	 */
	protected $_options = array(
      'graph' => array('ratio' => 'compress'),
      'node'  => array('fontsize' => 11, 'fontname' => 'Myriad', 'shape' => 'record'),
      'edge'  => array('fontsize' => 9, 'fontname' => 'Myriad', 'color' => 'grey', 'arrowhead' => 'open', 'arrowsize' => 0.5),
      'node.instance' => array('fillcolor' => '#9999ff', 'style' => 'filled'),
      'node.static' => array('visible' => false, 'fillcolor' => '#eeeeee', 'style' => 'filled'),
      'node.spiral' => array('visible' => true, 'fillcolor' => '#ffffff', 'style' => 'filled'),
    );

	protected function _initOutput($options)
	{
		foreach (array('graph', 'node', 'edge', 'node.instance', 'node.static', 'node.spiral') as $key)
			{
			  if (isset($options[$key]))
			  {
				$this->options[$key] = array_merge($this->options[$key], $options[$key]);
			  }
			}

			$output  = "digraph sc {\n";
			$output .= '  ratio="'.$this->_options['graph']['ratio'].'"'."\n"
					 . '  node [fontsize="'.$this->_options['node']['fontsize'].'" fontname="'.$this->_options['node']['fontname'].'" shape="'.$this->_options['node']['shape'].'"];'."\n"
					. '  edge [fontsize="'.$this->_options['edge']['fontsize'].'" fontname="'.$this->_options['edge']['fontname'].'" color="'.$this->_options['edge']['color'].'" arrowhead="'.$this->_options['edge']['arrowhead'].'" arrowsize="'.$this->_options['edge']['arrowsize'].'"];'."\n\n";
					
	return $output;
	}
	
	/**
	 * Method to filter strings
	 *
	 * @param	string	$string
	 * @return	string
	 */
	protected function _filterNodeString($string)
	{
		$string = preg_replace('#\\\#', '_', $string);
		return strtolower($string);
	}
	
	protected function _filterLabelString($string)
	{
		return preg_replace('#\\\#', '\\\\\\', $string);
	}
	
	protected function _getNodeOptions($id)
	{
		return 'fillcolor="'.$this->_options['node.'.$id]['fillcolor'].'", style="'.$this->_options['node.'.$id]['style'].'"';
	}

	/**
	 * Store the schema onto a dot string
	 *
	 * @param	Schema	$schema		The schema object to dump
	 * @param	array 	$parameters	Some useful parameters
	 * @return 	string
	 */
	public function dump($options = array())
	{
		$output = $this->_initOutput($options);
		if ($this->_options['node.spiral']['visible'])
		{
			$output .= '  node_spiral [label="Spiral Dependency \n Injection Schema", '.$this->_getNodeOptions('spiral')."]\n";
		}
		foreach($this->_schema as $service)
		{
			$currentServiceNode = '  node_service_'.$service->getName();
			$output .= $currentServiceNode.' [label = "'.$service->getName().'\n '.$this->_filterLabelString($service->getClassName()).'", '.$this->_getNodeOptions('instance').']'.";\n";
			foreach($service as $method)
			{				
				if ($method->isStatic() && $this->_options['node.static']['visible'])
				{
					$currentMethodNode = '  node_static_class_'.$this->_filterNodeString($method->getClass());
					$output .= $currentMethodNode.' [label = "'.$this->_filterLabelString($method->getClass()).'\n (static class)"'.', '.$this->_getNodeOptions('static').']'.";\n";
					$output .= $currentServiceNode.' -> '.$currentMethodNode.' [label="'.$method->getName().'()", style="dashed"]'.";\n";
				}
				
				foreach($method as $arg)
				{
					if($arg[1] == 'ARG_IS_SERVICE' && $arg[0] != 'SPIRAL_DI_ACTIVE_SERVICE')
					{
						$output .= $currentServiceNode.' -> '. 'node_service_'.$arg[0]."\n";
					}
					
				}
			}
		}
		$output .= '}';
		return $output;
	}
}
?>
