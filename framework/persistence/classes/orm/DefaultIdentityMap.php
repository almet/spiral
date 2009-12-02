<?php

namespace spiral\framework\persistence\orm;

/**
 * Default implementation of the identity map
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultIdentityMap implements IdentityMap
{
	/**
	 * Array of keeped objects
	 * 
	 * Keys are OIDs and values are objects.
	 * 
	 * @var	array
	 */
	private $_objects = array();
	
	/**
	 * Return if the given object belongs to the map
	 * 
	 * @param	object		$object		Object
	 * @return	boolean		TRUE if the object already belong to the map, FALSE else
	 */
	public function containsObject($object)
	{
		return array_search($object, $this->_objects, TRUE) !== FALSE;
	}
	
	/**
	 * Find the object associated to the given OID
	 * 
	 * Return NULL if no object is associated to the OID.
	 * 
	 * @param	mixed		$oid	OID of the object wanted
	 * @return	object		Object that is associated to the OID in the map, NULL if it does not exist
	 */
	public function findObjectByOID($oid)
	{
		if(!isset($this->_objects[$oid]))
		{
			return NULL;
		}
		
		return $this->_objects[$oid];
	}
	
	/**
	 * Find the OID associated to the given object
	 * 
	 * Return NULL if the object cannot be found in the map.
	 * 
	 * @param	object	$object Object
	 * @return	mixed	OID wanted or NULL is the object is not found
	 */
	public function findOIDByObject($object)
	{
		$index = array_search($object, $this->_objects, TRUE);
		
		if($index === FALSE)
		{
			return NULL;
		}
		
		return $index;
	}
	
	/**
	 * Register a new key/value pair
	 * 
	 * Associate the given object to the given OID into the map.
	 * 
	 * @param	mixed		$oid		OID
	 * @param	object		$object		In-memory object
	 * @return	void
	 */
	public function register($oid, $object)
	{
		$this->_objects[$oid] = $object;
	}
}