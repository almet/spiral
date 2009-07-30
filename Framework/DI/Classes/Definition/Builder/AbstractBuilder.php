<?php
namespace Spiral\Framework\DI\Definition\Builder;
use \Spiral\Framework\DI\Definition\DefaultSchema;
use \Spiral\Framework\DI\Definition\Schema;

/**
 * Abstract schema builder
 * 
 * This component make it possible to set the original schema to build on.
 *
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Frédéric sureau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractBuilder implements Builder
{
	private $_schema = null;

    /**
     * Return the original Schema
     * 
     * @return \Spiral\Framework\DI\Definition\Schema
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
     * @param   \Spiral\Framework\DI\Definition\Schema	$schema
     * @return  void
     */
    public function setOriginalSchema(Schema $schema)
    {
        $this->_schema = $schema;
    }
}
