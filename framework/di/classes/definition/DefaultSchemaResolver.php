<?php

namespace spiral\framework\di\definition;

/**
 * Resolver for default schema classes
 * 
 * Always provides the default implementation of classes
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultSchemaResolver implements SchemaResolver
{	
	/**
	 * Implementation name
	 *
	 * @var	string
	 */
	protected $_implementation = 'Default';
	protected $_namespace = '\spiral\framework\di\definition';
    
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
	 * 
	 * @param	string	Type of object to resolve
	 */
	protected function _resolveObject($objectType)
	{
		return $this->_namespace.'\\'.$this->_implementation.$objectType;
	}
}
