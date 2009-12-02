<?php

namespace spiral\framework\persistence\fixtures\orm;

use \spiral\framework\persistence\orm\AbstractUnitOfWork;

/**
 * Abstract unit of work with exposed protected attributes
 * for test purpose
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class ExposedAbstractUnitOfWork extends AbstractUnitOfWork
{
	public function exposedObjectsStatus()
	{
		return $this->_objectsStatus;
	}
	
	public function exposedObjects()
	{
		return $this->_objects;
	}
	
	protected function _commit()
	{
		echo 'committed';
	}
}