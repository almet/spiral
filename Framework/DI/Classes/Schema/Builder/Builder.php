<?php
namespace Spiral\Framework\DI\Schema\Builder;

/**
 * Schema builder
 * 
 * This component is an abstract builder (Design pattern Builder) for Di Schema.
 * 
 * @author  	Alexis Métaireau	22 apr. 2009
 * @author		Frédéric Sureau		10 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Builder
{
	/**
	 * Build the schema
	 *
	 * @return 	\Spiral\Framework\DI\Schema\Schema
	 */
	public function buildSchema();
}
?>
