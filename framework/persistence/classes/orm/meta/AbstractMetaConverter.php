<?php

namespace Spiral\Framework\Persistence\ORM\Conversion;

/**
 * Abstract meta object converter
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class AbstractMetaConverter implements MetaConverter
{
	/**
	 * Create an instance of the given class
	 * 
	 * @param	string		$class			Class
	 * @param	array		$attributes		Attributes
	 * 
	 * @return	object		Instance
	 */
	protected function _createInstance($class, $attributes)
	{
		// Create the instance by a "wake up" process thanks to unserialize
		// The constructor will not be called, but the __wakeup method will 
		$instance = unserialize('O:'.strlen($class).':"'.$class.'":0:{}');
		
		$reflectionObject = new \ReflectionObject($instance);
		$reflectionProperties = $reflectionObject->getProperties();
		
		foreach($attributes as $property)
		{
			$reflectionProperty = new \ReflectionProperty($class, $name);
			$reflectionProperty->setAccessible(true);
			
			$value = $attributes[$property->getName()];
			$property->setValue($value);
		}
		
		return $instance;
	}
	
	/**
	 * Create a meta object with the given parameters
	 * 
	 * @param	string		$class			Class
	 * @param	array		$attributes		Attributes
	 * 
	 * @return	MetaObject		The meta object
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