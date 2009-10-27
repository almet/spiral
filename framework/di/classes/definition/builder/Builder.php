<?php

namespace spiral\framework\di\definition\builder;

use \spiral\framework\di\definition\Schema;

/**
 * Schema builder
 * 
 * This component is an abstract builder (Design pattern Builder) for Di Schema.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface Builder
{
	/**
	 * Build the schema
	 *
	 * @return 	Schema
	 */
	public function buildSchema();
}
