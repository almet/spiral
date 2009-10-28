<?php

namespace Spiral\Framework\Persistence\Fixtures\ORM\Backend;

use \Spiral\Framework\Persistence\ORM\Backend\StorageEngine;
use \Spiral\Framework\Persistence\ORM\MetaObject;

class MockStorageEngine implements StorageEngine
{
	/**
	 * List of events asked to the storage engine
	 * 
	 * @var	array
	 */
	public $events = array();
	
	public function delete($oid)
	{
		$this->events[] = array('DELETE', $oid, null);
	}
	
	public function generateOID(MetaObject $metaObject)
	{
		return spl_object_hash($metaObject);
	}
	
	public function insert($oid, MetaObject $metaObject)
	{
		$this->events[] = array('INSERT', $oid, $metaObject);
	}
	
	public function update($oid, MetaObject $metaObject)
	{
		$this->events[] = array('UPDATE', $oid, $metaObject);
	}
}