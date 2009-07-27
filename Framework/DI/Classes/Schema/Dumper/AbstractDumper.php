<?php

/**
 * Abstract Dumper class
 *
 * @package     SpiralDi
 * @subpackage  Dumper 
 * @author  	Alexis Métaireau	22 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
abstract class SpiralDi_Dumper_Abstract implements SpiralDi_Dumper
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
	public function __construct(SpiralDi_Schema $schema)
	{
		$this->_schema = $schema;
	}
}
?>
