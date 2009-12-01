<?php

namespace spiral\framework\persistence\orm\meta;

/**
 * Reflection based meta object converter
 * 
 * This component uses reflection to build meta object.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ReflectionMetaConverter extends ObjectRepositoryMetaConverter
{
	/**
	 * Convert an in-memory instance to a meta representation object 
	 * 
	 * @param	object		$instance		The in-memory instance
	 * @param	mixed		$oid			The OID associated to this instance
	 * @return	MetaObject	The meta object representation of the instance
	 */
	public function convertToMetaObject($instance, $oid)
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
				$value = $this->_convertInstanceToMetaValue($value);
			}
			
			$metaAttributes[$name] = $value;
		}
		
		$metaAttributes['oid'] = $oid;
		
		return $this->_createMetaObject(get_class($instance), $metaAttributes);
	}
	
	/**
	 * Convert a meta object representation to an in-memory instance
	 * 
	 * @param	MetaObject	$metaObject		The meta object to build
	 * @return	object		The instance represented by the meta object
	 */
	public function convertToInstance(MetaObject $metaObject)
	{
		$metaAttributes = $metaObject->getAttributes();
		$class = $metaObject->getClass();
		
		// FIXME : Maybe check before if the 'oid' key exists
		unset($metaAttributes['oid']);
		
		$attributes = array();
		foreach($metaAttributes as $name=>$value)
		{
			// FIXME : Use reflection on @var instead ?
			if(is_string($value) && strlen($value) == 32)
			{
				$value = $this->_convertMetaValueToInstance($value);
			}
			
			$attributes[$name] = $value;
		}
		
		return $this->_createInstance($class, $attributes);
	}
}