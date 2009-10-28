<?php

namespace spiral\framework\persistence\orm;

interface OIDGenerator
{
	public function generateOID($object);
}