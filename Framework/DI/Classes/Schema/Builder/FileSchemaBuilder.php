<?php

/**
 * Schema builder from a file name
 * 
 * This component make it possible to set the file name has a source of building.
 *
 * @package     SpiralDi
 * @subpackage  SchemaBuilder  
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Frederic Sureau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class SpiralDi_SchemaBuilder_File extends SpiralDi_SchemaBuilder_Abstract
{
    /**
     * Set the file name to build
     * @param   string  $fileName
     */
	abstract public function setFileName($fileName);
}
