<?php

namespace Spiral\Framework\Persistence\ORM;

use Spiral\Framework\Persistence\ObjectRepository;

/**
 * Object repository meta object transformer
 * 
 * This component uses object repository to manage relations.
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
abstract class ObjectRepositoryMetaObjectTransformer extends AbstractMetaObjectTransformer
{
	/**
	 * Object repository
	 * 
	 * @var	ObjectRepository
	 */
	protected $_objectRepository;
	
	/**
	 * Transform an object instance to an atomic meta representation 
	 * 
	 * @param	object		$instance		The in-memory object
	 * 
	 * @return	mixed		Atomic representation of the instance
	 */
	protected function _transformInstanceToMetaValue($instance)
	{
		return $this->_objectRepository->add($instance);
	}
	
	/**
	 * Transform a meta object representation to an object instance
	 * 
	 * @param	mixed		$meta		The meta representation
	 * 
	 * @return	object		The instance of the object
	 */
	protected function _transformMetaValueToInstance($meta)
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