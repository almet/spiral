<?php
namespace spiral\core\di\dumper;
use spiral\core\di\schema\Schema;

/**
 *
 * Abstract Dumper class
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
abstract class Dumper_Abstract implements Dumper
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
	 */
	public function __construct(Schema $schema)
	{
		$this->_schema = $schema;
	}
}
?>
