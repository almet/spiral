<?php

class EntityIdResolver_Default implements EntityIdResolver
{
	public function resolveEntityId($entityType)
	{
		return 'id';
	}
}

?>