<?php

namespace spiral\framework\persistence\fixtures\orm\meta;

use \spiral\framework\persistence\orm\meta\ObjectRepositoryMetaConverter;
use \spiral\framework\persistence\orm\meta\MetaObject;

/**
 * Object repository meta converter with exposed protected methods
 * for test purpose
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ExposedObjectRepositoryMetaConverter extends ObjectRepositoryMetaConverter
{
	public function exposedConvertInstanceToMetaValue($instance)
	{
		return $this->_convertInstanceToMetaValue($instance);
	}

	public function exposedConvertMetaValueToInstance($meta)
	{
		return $this->_convertMetaValueToInstance($meta);
	}
	
	public function convertToMetaObject($instance, $oid)
	{
		
	}
	
	public function convertToInstance(MetaObject $metaObject)
	{
		
	}
}