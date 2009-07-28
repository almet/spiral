<?php
namespace \Spiral\Framework\DI\Schema\Builder;

/**
 * Schema builder from a file name
 * 
 * This component make it possible to set the file name has a source of building.
 *
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Frederic Sureau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class FileBuilder extends AbstractBuilder
{
    /**
     * Set the file name to build
     *
     * @param   string  $fileName
     */
	abstract public function setFileName($fileName);
}
