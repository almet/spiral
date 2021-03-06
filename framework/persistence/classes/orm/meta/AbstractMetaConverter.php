<?php

namespace spiral\framework\persistence\orm\meta;

/**
 * Abstract meta object converter
 * 
 * Provide protected methods to create blank in-memory objects and meta objects.
 * Also provide basics methods to convert simple values.
 * 
 * @todo		Encapsulation via inheritance is bad !
 * 				This abstract class should be replaced by an ObjectCreator or something like that...
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractMetaConverter implements MetaConverter
{
	/**
	 * Create an instance of the given class
	 * 
	 * @param	string		$class			Class
	 * @param	array		$attributes		Attributes
	 * @return	object		Instance
	 */
	protected function _createInstance($class, $attributes)
	{
		// Create the instance by a "wake up" process thanks to unserialize
		// The constructor will not be called, but the __wakeup method will 
		$instance = unserialize('O:'.strlen($class).':"'.$class.'":0:{}');
		
		$reflectionObject = new \ReflectionObject($instance);
		$reflectionProperties = $reflectionObject->getProperties();
		
		foreach($attributes as $name=>$value)
		{
			$reflectionProperty = new \ReflectionProperty($class, $name);
			$reflectionProperty->setAccessible(true);
			$reflectionProperty->setValue($instance, $value);
		}
		
		return $instance;
	}
	
	/**
	 * Create a meta object with the given parameters
	 * 
	 * @param	string			$class				Class
	 * @param	array			$attributes			Attributes
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