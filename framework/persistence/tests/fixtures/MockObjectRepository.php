<?php

namespace spiral\framework\persistence\fixtures;

use \spiral\framework\persistence\query\Query;
use \spiral\framework\persistence\ObjectRepository;

/**
 * Mock object repository for test purpose
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
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