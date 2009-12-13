<?php
namespace spiral\framework\di\transformation\dumpers;

use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\ServiceReferenceArgument;

/**
 * Text Dumper.
 *
 * Dump a schema into a human readable text.
 *
 * @author	Alexis Metaireau <alexis@spiral-project.org>
 * @copyright   2009 Spiral-project.org <http://www.spiral-project.org>
 * @license     GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class TextDumper extends AbstractDumper
{
    /**
     * Dump the given schema instance into a string.
     *
     * @param   spiral\framework\di\definition\Schema
     * @return  mixed
     */
    public function dump(Schema $schema)
    {
        $this->setSchema($schema);
        $output = '';
        
        foreach($this->_schema->getServices() as $service)
        {
                $output .= '['.$service->getName()." - ".$service->getClassName()."]\n";
                foreach($service->getMethods() as $method)
                {
                        $output .= '-> call ';

                        if ($method->isStatic())
                        {
                                $output .= $method->getClass().'::';
                        }
                        $output .= '"'.$method->getName().'"'." with:\n";

                        foreach($method->getArguments() as $arg)
                        {
                                $output .= "\t- ";
echo get_class($arg);
                                if ($arg instanceof ServiceReferenceArgument)
                                {
                                        $output .= '['.$arg->getValue().']';
                                } else
                                {
                                        $output .= $arg->getValue();
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
