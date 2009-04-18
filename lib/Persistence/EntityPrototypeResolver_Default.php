<?php

class EntityPrototypeResolver_Default implements EntityPrototypeResolver
{
	public function resolveEntityPrototype($entityType)
	{
		$className = $entityType.'_Default';	
		return new $className();
	}
}

?>