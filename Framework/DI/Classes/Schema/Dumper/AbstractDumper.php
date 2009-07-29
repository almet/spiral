<?php
namespace Spiral\Framework\DI\Schema\Dumper;
use \Spiral\Framework\DI\Schema\Schema;

/**
 * Abstract Dumper class
 *
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
abstract class AbstractDumper implements Dumper
{

	/**
	 * The Schema object
	 *
	 * @var	\Spiral\Framework\DI\Schema\Schema
	 */
	protected $_schema = null;
	
	/**
	 * Store the Schema object and instanciate the class
	 * 
	 * @param	\Spiral\Framework\DI\Schema\Schema	$schema
     * @return  void
	 */
	public function __construct(Schema $schema)
	{
		$this->_schema = $schema;
	}
}
