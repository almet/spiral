<?php

class EntityAttributesValuesResolver_Default implements EntityAttributesValuesResolver
{
	public function resolveEntityAttributesValues($entityType, $entity, array $wantedAttributes)
	{
		$return = array();
		
		foreach($wantedAttributes as $a)
		{
			$return[$a] = $entity->$a;
		}
		
		return $return;
	}
}

?>