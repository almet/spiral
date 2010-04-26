<?php
namespace spiral\framework\di\transformation\dumpers;

use spiral\framework\di\definition\Schema;

/**
 * Dumper interface.
 *
 * Defines how to interact with dumpers objects / classes
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class Dumper
{    
    /**
     * Dump a schema into another format
     *
     * @param   spiral\framework\di\definition\Schema
     * @return  mixed     
     */
    public function dump(Schema $schema);
}
?>
