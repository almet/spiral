<?php
namespace spiral\framework\di\transformation\dumpers;

use spiral\framework\di\definition\Schema;

/**
 * Abstract base class for dumpers, providing some base functionalities.
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractDumper
{
    /**
     * The schema instance
     *
     * @var spiral\framework\di\definition\Schema
     */
    protected $_schema = null;
	
    /**
     * Set the original Schema
     *
     * @param   Schema	$schema
     * @return  void
     */
    public function setSchema(Schema $schema)
    {
        $this->_schema = $schema;
    }
}
?>
