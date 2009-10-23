<?php

namespace Spiral\Framework\Persistence\Fixtures;

use \Spiral\Framework\Persistence\Query\Query;
use \Spiral\Framework\Persistence\ObjectRepository;

class MockObjectRepository implements ObjectRepository
{
	private $_objects = array();
	
	public function add($object)
	{
		$oid = spl_object_hash($object);
		$this->_objects[$oid] = $object;
		
		return $oid;
	}
	
	public function remove($object)
	{
		$oid = spl_object_hash($object);
		unset($this->_objects[$oid]);
	}
	
	public function findByOID($oid)
	{
		return $this->_objects[$oid];
	}
	
	public function findByQuery(Query $query)
	{
		throw new Exception('Not yet implemented');
	}
}