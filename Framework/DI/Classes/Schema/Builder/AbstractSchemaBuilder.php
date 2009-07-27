<?php

/**
 * Abstract schema builder
 * 
 * This component make it possible to set the original schema to build on.
 *
 * @package     SpiralDi
 * @subpackage  SchemaBuilder  
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Frédéric sureau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class SpiralDi_SchemaBuilder_Abstract implements SpiralDi_SchemaBuilder
{
	private $_schema = null;

    /**
     * Return the original Schema
     * 
     * @return SpiralDi_Schema
     */
    public function getOriginalSchema()
    {
        if(empty($this->_schema))
        {
        	$this->_schema = new SpiralDi_Schema_Default();
        }

        return $this->_schema;
    }

    /**
     * Set the original Schema
     * 
     * @param   SpiralDi_Schema $schema
     * @return  void
     */
    public function setOriginalSchema(SpiralDi_Schema $schema)
    {
        $this->_schema = $schema;
    }
}
