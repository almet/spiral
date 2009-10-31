<?php

namespace spiral\framework\persistence\orm;

// FIXME Objects should maybe be compared on more than just the OID
// Example : I want to add Article(oid=>null,id=>34) but Article(oid=>XX,id=>34) already exists
interface IdentityMap
{
	public function register($oid, $object);
	public function containsObject($object);
	public function findOIDByObject($object);
	public function findObjectByOID($oid);
}