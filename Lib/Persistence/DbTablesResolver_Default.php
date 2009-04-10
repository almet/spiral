<?php

class DbTablesResolver_Default implements DbTablesResolver
{
	public function resolveDbTables($entityType)
	{
		return array(strtolower($entityType).'s');
	}
}

?>