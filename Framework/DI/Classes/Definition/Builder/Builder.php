<?php
namespace Spiral\Framework\DI\Definition\Builder;

/**
 * Schema builder
 * 
 * This component is an abstract builder (Design pattern Builder) for Di Schema.
 * 
 * @author  	Alexis Métaireau	22 apr. 2009
 * @author		Frédéric Sureau		10 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Builder
{
	/**
	 * Build the schema
	 *
	 * @return 	\Spiral\Framework\DI\Definition\Schema
	 */
	public function buildSchema();
}
?>
