<?php

namespace Spiral\Framework\Persistence\Fixtures\ORM\Conversion;

use \Spiral\Framework\Persistence\ORM\Conversion\MetaConverter;
use \Spiral\Framework\Persistence\ORM\DefaultMetaObject;
use \Spiral\Framework\Persistence\ORM\MetaObject;

class MockMetaConverter implements MetaConverter
{
	public $convertedToMetaObjects = array();
	public $convertedToInstances = array();
	
	public function convertToMetaObject($instance)
	{
		$metaObject = new DefaultMetaObject();
		$metaObject->setAttributes(get_object_vars($instance));
		$metaObject->setClass(get_class($instance));
		
		$this->convertedToMetaObjects[spl_object_hash($metaObject)] = $metaObject;
		
		return $metaObject;
	}
	
	public function convertToInstance(MetaObject $metaObject)
	{
		$class = $metaObject->getClass();
		$attributes = $metaObject->getAttributes();
		
		$instance = new $class();
		foreach($attributes as $name=>$value)
		{
			$instance->$name = $value;
		}
		
		$this->convertedToInstances[spl_object_hash($metaObject)] = $metaObject;
		
		return $instance;
	}
}