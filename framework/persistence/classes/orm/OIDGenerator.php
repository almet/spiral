<?php

namespace spiral\framework\persistence\orm;

/**
 * OID generator
 * 
 * This component is responsible of generating OID for in-memory objects.
 * OIDs must be scalar PHP values and be unique.
 * 
 * Common implementations could be:
 * 	- use the hash of the object
 * 	- ask the storage engine for a unique ID
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface OIDGenerator
{
	/**
	 * Generate an OID for the given object
	 * 
	 * @param	object	$object		Object
	 * @return	mixed	OID
	 */
	public function generateOID($object);
}