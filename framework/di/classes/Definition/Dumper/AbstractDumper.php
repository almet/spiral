<?php
namespace Spiral\Framework\DI\Definition\Dumper;
use \Spiral\Framework\DI\Definition\Schema;

/**
 * Abstract Dumper class
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
abstract class AbstractDumper implements Dumper
{

	/**
	 * The Schema object
	 *
	 * @var	\Spiral\Framework\DI\Definition\Schema
	 */
	protected $_schema = null;
	
	/**
	 * Store the Schema object and instanciate the class
	 * 
	 * @param	\Spiral\Framework\DI\Definition\Schema	$schema
     * @return  void
	 */
	public function __construct(Schema $schema)
	{
		$this->_schema = $schema;
	}
}
