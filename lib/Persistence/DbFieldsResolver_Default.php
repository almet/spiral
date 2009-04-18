<?php

class DbFieldsResolver_Default implements DbFieldsResolver
{
	public function resolveDbFields($entityType, array $fields)
	{
		$return = array();
		
		foreach ($fields as $field)
		{
			$return[$field] = strtolower($entityType).'_'.strtolower($field);
		}
		
		return $return;
	}
}

?>