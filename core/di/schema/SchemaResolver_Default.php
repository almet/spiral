<?php
namespace spiral\core\di\schema;
use spiral\core\di\schema\Schema_Default,
	spiral\core\di\schema\Service_Default,
	spiral\core\di\schema\Method_Default;

/**
 * Resolver for default schema classes
 * 
 * Always provides the default implementation of classes
 *
 * @author  	Alexis Métaireau	20 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class SchemaResolver_Default implements SchemaResolver
{	
	/**
	 * Implementation name
	 *
	 * @var	string
	 */
	protected $_implementation = 'Default';
	protected $_namespace = 'spiral\\core\\di\\schema\\';

	public function resolveSchema()
	{
		return $this->_namespace.'Schema_'.$this->_implementation;
	}
	
	public function resolveService()
	{
		return $this->_namespace.'Service_'.$this->_implementation;
	}
	
	public function resolveMethod()
	{
		return $this->_namespace.'Method_'.$this->_implementation;
	}
	
	
}
