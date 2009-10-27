<?php

namespace spiral\framework\di\definition\dumper;

use \spiral\framework\di\definition\Schema;

/**
 * Abstract Dumper class
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractDumper implements Dumper
{
	/**
	 * The Schema object
	 *
	 * @var	Schema
	 */
	protected $_schema = null;
	
	/**
	 * Store the Schema object and instanciate the class
	 * 
	 * @param	Schema	$schema
     * @return  void
	 */
	public function __construct(Schema $schema)
	{
		$this->_schema = $schema;
	}
}
