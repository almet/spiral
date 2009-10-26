<?php

namespace Spiral\Framework\Persistence\Fixtures\ORM;

use \Spiral\Framework\Persistence\ORM\UnitOfWork;
use \Spiral\Framework\Persistence\ORM\MetaObject;

class MockUnitOfWork implements UnitOfWork
{
	public $registrations = array();
	
	public function commit()
	{
		$this->registrations = array();
	}
	
	public function rollback()
	{
		$this->registrations = array();
	}
	
	public function registerDeleted($oid)
	{
		$this->registrations[] = array('DELETED', $oid, null);
	}
	
	public function registerDirty($oid, $object)
	{
		$this->registrations[] = array('DIRTY', $oid, $object);
	}
	
	public function registerNew($oid, $object)
	{
		$this->registrations[] = array('NEW', $oid, $object);
	}
}