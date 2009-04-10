<?php

interface DbFieldsResolver
{
	public function resolveDbFields($entityType, array $fields);
}

?>