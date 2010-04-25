<?php

namespace spiral\framework\persistence\orm\backend;

use \spiral\framework\persistence\orm\meta\MetaObject;

/**
 * Storage engine
 * 
 * The storage engine is responsible of storing meta object representations in a persistent support.
 * For example, a typical storage engine is an adapter to a relational database.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html
 * 
 * FIXME : Don't forget the select method
 */
interface StorageEngine
{
	/**
	 * Delete the meta object from the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function delete(MetaObject $metaObject);
	
	/**
	 * Insert the meta object in the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function insert(MetaObject $metaObject);
	
	/**
	 * Update the meta object in the storage engine
	 * 
	 * @param	MetaObject	$metaObject		Meta object
	 * @return	void
	 */
	public function update(MetaObject $metaObject);
}
