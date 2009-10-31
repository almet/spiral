<?php

namespace spiral\framework\persistence\orm;

interface IdentityMap
{
	public function containsObject($object);
	public function findObjectByOID($oid);
	public function findOIDByObject($object);
	public function register($oid, $object);
}