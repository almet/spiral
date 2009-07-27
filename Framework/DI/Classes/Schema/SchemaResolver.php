<?php

/**
 * Resolver for all schema classes
 * 
 * This interface provide methods useful to construct schema classes:
 * - Method
 * - Schema
 * - Service
 *
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface SpiralDi_Schema_SchemaResolver
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
