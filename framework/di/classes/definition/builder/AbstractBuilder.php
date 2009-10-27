<?php

namespace spiral\framework\di\definition\builder;

use \spiral\framework\di\definition\DefaultSchema;
use \spiral\framework\di\definition\Schema;

/**
 * Abstract schema builder
 * 
 * This component make it possible to set the original schema to build on.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractBuilder implements Builder
{
	// TODO Comment
	private $_schema = null;

    /**
     * Return the original Schema
     * 
     * @return Schema
     */
    public function getOriginalSchema()
    {
        if(empty($this->_schema))
        {
        	$this->_schema = new DefaultSchema();
        }

        return $this->_schema;
    }

    /**
     * Set the original Schema
     * 
     * @param   Schema	$schema
     * @return  void
     */
    public function setOriginalSchema(Schema $schema)
    {
        $this->_schema = $schema;
    }
}
