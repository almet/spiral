<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Reflection based meta object transformer
 * 
 * This component uses reflection to build meta object.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class ReflectionMetaObjectTransformer extends ObjectRepositoryMetaObjectTransformer
{
	/**
	 * Transform an in-memory instance to a meta representation object 
	 * 
	 * @param	object		$instance		The in-memory instance
	 * 
	 * @return	MetaObject	The meta object representation of the instance
	 */
	public function transformToMetaObject($instance)
	{
		$reflectionObject = new \ReflectionObject($instance);
		$reflectionAttributes = $reflectionObject->getProperties();
		
		$metaAttributes = array();
		foreach($reflectionAttributes as $reflectionAttribute)
		{
			$reflectionAttribute->setAccessible(true);
			$name = $reflectionAttribute->getName();
			$value = $reflectionAttribute->getValue($instance);
			
			if(is_object($value))
			{
				$value = $this->_transformInstanceToMetaValue($value);
			}
			
			$metaAttributes[$name] = $value;
		}
		
		// FIXME : Maybe use a prototype instead
		$metaObject = new DefaultMetaObject();
		$metaObject->setAttributes($metaAttributes);
		$metaObject->setClass(get_class($instance));
		
		return $metaObject;
	}
	
	/**
	 * Transform a meta object representation to an in-memory instance
	 * 
	 * @param	MetaObject	$metaObject		The meta object to build
	 * 
	 * @return	object		The instance represented by the meta object
	 */
	public function transformToInstance(MetaObject $metaObject)
	{
		$metaAttributes = $metaObject->getAttributes();
		$class = $metaObject->getClass();
		
		// Create the instance by a "wake up" process thanks to unserialize
		// The constructor will not be called, but the __wakeup method will 
		$instance = unserialize('O:'.strlen($class).':"'.$class.'":0:{}');
		
		foreach($metaAttributes as $name=>$value)
		{
			$reflectionProperty = new \ReflectionProperty($class, $name);
			$reflectionProperty->setAccessible(true);
			
			// FIXME : Use reflection on @var instead ?
			if(is_string($value) && strlen($value) == 32)
			{
				$value = $this->_transformMetaValueToInstance($value);
			}
			
			$reflectionProperty->setValue($instance, $value);
		}
		
		return $instance;
	}
}