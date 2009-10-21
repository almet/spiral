<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Abstract service
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractServiceConstructionStrategy extends AbstractConstructionStrategy
{	
	/**
	 * Service
	 * 
	 * @var \Spiral\Framework\DI\Definition\Service
	 */
	protected $_service;
	
	/**
	 * Setter for service
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\service	$service
	 * @return	void
	 */
	public function setService(Definition\Service $service){
		$this->_service = $service;
	}
	
	/**
	 * Getter for service
	 * 
	 * @return \Spiral\Framework\DI\Definition\Service
	 */
	public function getService(){
		return $this->_service;
	}
	
}