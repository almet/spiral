<?php

namespace spiral\framework\persistence\orm\meta;

use \spiral\framework\persistence\ObjectRepository;

/**
 * Object repository meta object converter
 * 
 * This component uses the {@link ObjectRepository} to manage relations.
 * When an object need to be converted to a {@link MetaObject}, all relations are added
 * to the {@link ObjectRepository} first and replaced by OIDs that the {@link ObjectRepository}
 * has returned.
 * 
 * @see		ObjectRepository
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class ObjectRepositoryMetaConverter extends AbstractMetaConverter
{
	/**
	 * Object repository
	 * 
	 * @var	ObjectRepository
	 */
	protected $_objectRepository;
	
	/**
	 * Convert an object instance to an atomic meta representation 
	 * 
	 * @param	object		$instance		The in-memory object
	 * @return	mixed		Atomic representation of the instance
	 */
	protected function _convertInstanceToMetaValue($instance)
	{
		return $this->_objectRepository->add($instance);
	}
	
	/**
	 * Convert a meta object representation to an object instance
	 * 
	 * @param	mixed		$meta		The meta representation
	 * @return	object		The instance of the object
	 */
	protected function _convertMetaValueToInstance($meta)
	{
		return $this->_objectRepository->findByOID($meta);
	}
	
	/**
	 * Define the object repository
	 * 
	 * @param	ObjectRepository		$objectRepository	Object repository
	 * @return	void
	 */
	public function setObjectRepository(ObjectRepository $objectRepository)
	{
		$this->_objectRepository = $objectRepository;
	}
}