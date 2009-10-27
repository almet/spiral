<?php

namespace spiral\framework\di\definition\dumper;

use \spiral\framework\di\definition\ServiceReferenceArgument;

/**
 * This specific dumper convert a schema object into a dot string.
 *
 * A dot file can be rendered by various programs into graphics.
 *
 * Thanks to Fabien Potencier for the idea of a dot dumper.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DOTDumper extends AbstractDumper
{

	/**
	 * Default options for generating dot files
     *
     * @var array
	 */
	protected $_options = array(
      'graph' => array(
            'ratio' => 'compress'),

      'node'  => array(
            'fontsize' => 11,
            'fontname' => 'Myriad',
            'shape' => 'record'),

      'edge'  => array(
            'fontsize' => 9,
            'fontname' => 'Myriad',
            'color' => 'grey',
            'arrowhead' => 'open',
            'arrowsize' => 0.5),

      'node.instance' => array(
            'fillcolor' => '#9999ff',
            'style' => 'filled'),
        
      'node.static' => array(
            'visible' => false,
            'fillcolor' => '#eeeeee',
            'style' => 'filled'),
        
      'node.spiral' => array(
            'visible' => true,
            'fillcolor' => '#ffffff',
            'style' => 'filled')
    );

    /**
     * Initialize the output thanks to options.
     * 
     * @param   array   $options
     * @return  string
     */
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
				 . '  node [fontsize="'.$this->_options['node']['fontsize']
                     .'" fontname="'.$this->_options['node']['fontname']
                     .'" shape="'.$this->_options['node']['shape'].'"];'."\n"

				 . ' edge [fontsize="'.$this->_options['edge']['fontsize']
                     .'" fontname="'.$this->_options['edge']['fontname']
                     .'" color="'.$this->_options['edge']['color']
                     .'" arrowhead="'.$this->_options['edge']['arrowhead']
                     .'" arrowsize="'.$this->_options['edge']['arrowsize'].'"];'
                     ."\n\n";
				
        return $output;
	}
	
	/**
	 * Escape node strings before sending them to output
	 *
	 * @param	string	$string
	 * @return	string
	 */
	protected function _escapeNodeString($string)
	{
		$string = str_replace('\\', '_', $string);
		return strtolower($string);
	}

    /**
     * Escape label strings before sending them to output
     * 
     * @param   string  $string
     * @return  string
     */
	protected function _escapeLabelString($string)
	{
		return str_replace('\\', '\\\\', $string);
	}

    /**
     * Build a node string usgin it's type
     * 
     * @param   string  $type
     * @return  string
     */
	protected function _getNodeOptions($type)
	{
		return  'fillcolor="'.$this->_options['node.'.$type]['fillcolor']
                .'", style="'.$this->_options['node.'.$type]['style'].'"';
	}

	/**
	 * Store the schema onto a dot string
	 *
	 * @param	array 	$parameters	Some useful parameters
	 * @return 	string
	 */
	public function dump($options = array())
	{
		$output = $this->_initOutput($options);
		if ($this->_options['node.spiral']['visible'])
		{
			$output .= '  node_spiral [label="Spiral Dependency \n Injection Schema", '
            .$this->_getNodeOptions('spiral')."]\n";
		}

        // create a node for each registred service
		foreach($this->_schema as $service)
		{
			$currentServiceNode = '  node_service_'.$service->getName();
            
			$output .= $currentServiceNode.' [label = "'.$service->getName()
                .'\n '.$this->_escapeLabelString($service->getClassName()).'", '
                .$this->_getNodeOptions('instance').']'.";\n";

            // foreach method call
			foreach($service as $method)
			{
                // display it if it's static
				if ($method->isStatic() && $this->_options['node.static']['visible'])
				{
					$currentMethodNode = '  node_static_class_'
                        .$this->_escapeNodeString($method->getClass());
                        
					$output .= $currentMethodNode.' [label = "'
                        .$this->_escapeLabelString($method->getClass()).'\n (static class)"'
                        .', '.$this->_getNodeOptions('static').']'.";\n";
                        
					$output .= $currentServiceNode.' -> '.$currentMethodNode
                        .' [label="'.$method->getName().'()", style="dashed"]'
                        .";\n";
				}

                // or if theses methods link to other services
				foreach($method as $argument)
				{
					var_dump($argument);
					if( $argument instanceof ServiceReferenceArgument)
					{
						$output .= $currentServiceNode.' -> '. 'node_service_'
                            .$argument->getValue()."\n";
					}
					
				}
			}
		}
		$output .= '}';
		return $output;
	}
}
