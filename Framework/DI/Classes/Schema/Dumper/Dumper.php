<?php
namespace Spiral\Framework\DI\Schema\Dumper;
use \Spiral\Framework\DI\Schema\Schema;

/**
 * The generic dumper interface presented here is used to dump the content of a
 * Schema object onto another form. In order to store it and reload it.
 * 
 * So, a dumper object can convert, for instance a schema object into .ini files
 * or dependency schemas. 
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Dumper
{
	/**
	 * Dump the schema
	 *
	 * @param	\Spiral\Framework\DI\Schema\Schema     $schema		The schema object to dump
	 * @return 	void
	 */
	public function __construct(Schema $schema);
}
