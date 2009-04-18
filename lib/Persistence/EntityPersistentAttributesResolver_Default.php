<?php

class EntityPersistentAttributesResolver_Default implements EntityPersistentAttributesResolver
{
	public function resolveEntityPersistentAttributes($entityType)
	{
		$className = $entityType.'_Default';
		return array_keys(get_class_vars($className));
	}
}

?>