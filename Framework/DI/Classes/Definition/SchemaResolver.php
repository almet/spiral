<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Resolver for all schema classes
 * 
 * This interface provide methods useful to construct schema classes:
 * - Method
 * - Schema
 * - Service
 *
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface SchemaResolver
{
	/**
	 * Resolve the schema class to use
	 * 
	 * @return	string
	 */
	public function resolveSchema();
	
	/**
	 * Resolve the service class to use
	 *
	 * @return 	string
	 */
	public function resolveService();
	
	/**
	 * Resolve the method class to use
	 *
	 * @return 	string
	 */
	public function resolveMethod();
}
