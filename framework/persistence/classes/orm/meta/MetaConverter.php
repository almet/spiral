<?php

namespace spiral\framework\persistence\orm\meta;

/**
 * Meta object converter
 * 
 * The meta object converter is the component responsible of transformation from in-memory 
 * instance to meta object representation.
 * It is also responsible of the instanciation from meta object to in-memory object.
 * 
 * All attributes of the meta object representation need to have atomic values.
 * 
 * @see			MetaObject
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface MetaConverter
{
	/**
	 * Convert an in-memory instance to a meta representation object 
	 * 
	 * @param	object		$instance		The in-memory instance
	 * @param	mixed		$oid			The OID associated to this instance
	 * @return	MetaObject	The meta object representation of the instance
	 */
	public function convertToMetaObject($instance, $oid);
	
	/**
	 * Convert a meta object representation to an in-memory instance
	 * 
	 * @param	MetaObject	$metaObject		The meta object to build
	 * @return	object		The instance represented by the meta object
	 */
	public function convertToInstance(MetaObject $metaObject);
}