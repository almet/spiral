<?php

namespace Spiral\Framework\Persistence\ORM\Conversion;

use Spiral\Framework\Persistence\ObjectRepository;

/**
 * Object repository meta object converter
 * 
 * This component uses object repository to manage relations.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class ObjectRepositoryMetaConverter implements MetaConverter
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
	 * 
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
	 * 
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
	 * 
	 * @return	void
	 */
	public function setObjectRepository(ObjectRepository $objectRepository)
	{
		$this->_objectRepository = $objectRepository;
	}
}