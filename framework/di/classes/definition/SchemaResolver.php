<?php

namespace spiral\framework\di\definition;

/**
 * Resolver for all schema classes
 * 
 * This interface provide methods useful to construct schema classes:
 * - Method
 * - Schema
 * - Service
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
