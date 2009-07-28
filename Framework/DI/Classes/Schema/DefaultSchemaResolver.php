<?php
namespace Spiral\Framework\DI\Schema;

/**
 * Resolver for default schema classes
 * 
 * Always provides the default implementation of classes
 *
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class DefaultSchemaResolver implements SchemaResolver
{	
	/**
	 * Implementation name
	 *
	 * @var	string
	 */
	protected $_implementation = 'Default';
	protected $_namespace = '\Spiral\Framework\DI\Schema';
    
	/**
	 * Resolve the schema class to use
	 *
	 * @return	string
	 */
	public function resolveSchema()
	{
		return $this->_resolveObject('Schema');
	}
    
	/**
	 * Resolve the service class to use
	 *
	 * @return 	string
	 */
	public function resolveService()
	{
		return $this->_resolveObject('Service');
	}
    
	/**
	 * Resolve the method class to use
	 *
	 * @return 	string
	 */
	public function resolveMethod()
	{
		return $this->_resolveObject('Method');
	}
	
	/**
	 * Resolve an object with the default implementation
	 * @param	string	type of object to resolve
	 */
	protected function _resolveObject($objectType)
	{
		return $this->_namespace.'\\'.$this->_implementation.$objectType;
	}
	
}
