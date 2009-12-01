<?php

namespace spiral\framework\persistence\fixtures\orm\meta;

use \spiral\framework\persistence\orm\meta\AbstractMetaConverter;
use \spiral\framework\persistence\orm\meta\MetaObject;

/**
 * Abstract meta converter with exposed protected methods
 * for test purpose
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ExposedAbstractMetaConverter extends AbstractMetaConverter
{
	public function exposedCreateMetaObject($class, $attributes)
	{
		return $this->_createMetaObject($class, $attributes);
	}

	public function exposedCreateInstance($class, $attributes)
	{
		return $this->_createInstance($class, $attributes);
	}
	
	public function convertToMetaObject($instance, $oid)
	{
		
	}
	
	public function convertToInstance(MetaObject $metaObject)
	{
		
	}
}