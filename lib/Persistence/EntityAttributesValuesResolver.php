<?php

interface EntityAttributesValuesResolver
{
	public function resolveEntityAttributesValues($entityType, $entity, array $wantedAttributes);
}

?>