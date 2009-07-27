<?php
/**
 * Resolver for default schema classes
 * 
 * Always provides the default implementation of classes
 *
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class SpiralDi_Schema_SchemaResolver_Default implements SpiralDi_Schema_SchemaResolver
{	
	/**
	 * Implementation name
	 *
	 * @var	string
	 */
	protected $_implementation = 'Default';
	protected $_namespace = 'SpiralDi_';
    
	/**
	 * Resolve the schema class to use
	 *
	 * @return	string
	 */
	public function resolveSchema()
	{
		return $this->_namespace.'Schema_'.$this->_implementation;
	}
    
	/**
	 * Resolve the service class to use
	 *
	 * @return 	string
	 */
	public function resolveService()
	{
		return $this->_namespace.'Schema_Service_'.$this->_implementation;
	}
    
	/**
	 * Resolve the method class to use
	 *
	 * @return 	string
	 */
	public function resolveMethod()
	{
		return $this->_namespace.'Schema_Method_'.$this->_implementation;
	}
	
	
}
