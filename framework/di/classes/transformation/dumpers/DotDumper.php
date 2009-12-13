<?php
namespace spiral\framework\di\transformation\dumpers;

use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\ServiceReferenceArgument;
use \spiral\framework\di\definition\UseReferenceArgument;

/**
 * Short description
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class DotDumper extends AbstractDumper
{
    /**
     * Options for generating the dot output.
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
     * Dump the given schema instance into a string representing a dot graph.
     *
     * @param   spiral\framework\di\definition\Schema
     * @return  mixed        
     */
    public function dump(Schema $schema)
    {
        $this->setSchema($schema);
        $output = $this->_initializeOutputString();

        // output spiral information if needed
        if ($this->_options['node.spiral']['visible'])
        {
            $output .= '  node_spiral [label="Spiral Dependency \n Injection Schema", '
                    .$this->_getNodeMeta('spiral')."]\n";
        }

        // For each service, create a node
        foreach($this->_schema->getServices() as $service)
        {
            $currentServiceNode = '  node_service_'.$service->getName();

            $output .= $currentServiceNode.' [label = "'.$service->getName()
                    .'\n '.$this->_escapeLabel($service->getClassName()).'", '
                    .$this->_getNodeMeta('instance').']'.";\n";

            // foreach method call
            foreach($service->getMethods() as $method)
            {
                // display it if it's static
                if ($method->isStatic() && $this->_options['node.static']['visible'])
                {
                    $currentMethodNode = '  node_static_class_'
                        .$this->_escapeNode($method->getClass());
                    
                    $output .= $currentMethodNode.' [label = "'
                            .$this->_escapeLabel($method->getClass()).'\n (static class)"'
                            .', '.$this->_getNodeMeta('static').']'.";\n";
                    
                    $output .= $currentServiceNode.' -> '.$currentMethodNode
                            .' [label="'.$method->getName().'()", style="dashed"]'
                            .";\n";
                }

                // or if theses methods link to other services
                foreach($method->getArguments() as $arg)
                {
                    if ($arg instanceof ServiceReferenceArgument)
                    {
                        $output .= $currentServiceNode.' -> node_service_'
                                .$arg->getValue()."\n";
                    }
                }
            }
        }
        $output .= '}';
        
        return $output;
    }

    /**
     * Set options parameters
     * 
     * @param array $options
     */
    public function setOptions($options)
    {
        foreach (array('graph', 'node', 'edge', 'node.instance', 'node.static', 'node.spiral') as $key)
        {
            if (isset($options[$key]))
            {
                $this->_options[$key] = array_merge($this->_options[$key], $options[$key]);
            }
        }
    }

    /**
     * Initialize the output string
     *
     * @param   array   $options
     * @return  string
     */
    protected function _initializeOutputString()
    {
        $output  = "digraph sc {\n";
        $output .= '  ratio="'.$this->_options['graph']['ratio'].'"'."\n"
                 . '  node [fontsize="'.$this->_options['node']['fontsize']
        .'" fontname="'.$this->_options['node']['fontname']
        .'" shape="'.$this->_options['node']['shape'].'"];'."\n"

                 . '  edge [fontsize="'.$this->_options['edge']['fontsize']
        .'" fontname="'.$this->_options['edge']['fontname']
        .'" color="'.$this->_options['edge']['color']
        .'" arrowhead="'.$this->_options['edge']['arrowhead']
        .'" arrowsize="'.$this->_options['edge']['arrowsize'].'"];'
        ."\n\n";

        return $output;
    }

   /**
    * Escape node related strings
    *
    * Replace the '\' pattern by a _, and cast to lower.
    *
    * @param	string	$string
    * @return	string
    */
    protected function _escapeNode($string)
    {
        $string = preg_replace('#\\\#', '_', $string);
        return strtolower($string);
    }

   /**
    * Escape label related strings
    *
    * Replace the '\' pattern by an escaped one: '\\'
    *
    * @param   string  $string
    * @return  string
    */
    protected function _escapeLabel($string)
    {
        return preg_replace('#\\\#', '\\\\\\', $string);
    }

   /**
    * Build a node string using it's type (specified in the $_options array)
    *
    * @param   string  $type
    * @return  string
    */
    protected function _getNodeMeta($type)
    {
        return  'fillcolor="'.$this->_options['node.'.$type]['fillcolor']
        .'", style="'.$this->_options['node.'.$type]['style'].'"';
    }


}
?>
