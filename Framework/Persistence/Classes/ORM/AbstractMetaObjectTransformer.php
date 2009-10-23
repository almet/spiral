<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Abstract meta object transformer
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class AbstractMetaObjectTransformer implements MetaObjectTransformer
{
	/**
	 * Create an instance of the given class
	 * 
	 * @param	string		$class		Class
	 * 
	 * @return	object		Instance
	 */
	protected function _createInstance($class, $attributes)
	{
		$object = unserialize('O:'.strlen($class).':"'.$class.'":0:{}');
		
		$reflectionObject = new \ReflectionObject($object);
		$reflectionProperties = $reflectionObject->getProperties();
		
		foreach($reflectionProperties as $property)
		{
			$value = $attributes[$property->getName()];
			$property->setValue($value);
		}
		
		return $object;
	}
	
	/**
	 * Transform a relation representation to a relation instance
	 * 
	 * @param	mixed		$metaRelation	The relation representation
	 * 
	 * @return	object		The instance of the relation
	 */
	protected function _createMetaObject($class, $attributes)
	{
		// FIXME : Maybe use a prototype instead
		$metaObject = new DefaultMetaObject();
		$metaObject->setAttributes($attributes);
		$metaObject->setClass($class);
		
		return $metaObject;
	}
}