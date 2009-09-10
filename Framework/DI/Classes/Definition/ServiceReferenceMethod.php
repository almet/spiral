<?php
namespace Spiral\Framework\DI\Definition;

use \Spiral\Framework\DI\Definition\Exception\UnknownArgumentException;

/**
 * Use a service method
 *
 * See the interface for further information.
 * 
 * @author  	Alexis Métaireau	08 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class ServiceReferenceMethod extends DefaultMethod
{	
	/**
	 * Service reference
	 * 
	 * @var string
	 */
	protected $_serviceReferenceName = null;
		
    /**
	 * construct a method and set it's name
	 *
	 * @param	string	$methodName
	 * @param	string	$serviceReferenceName
	 */
	public function __construct($methodName, $serviceReferenceName = null)
	{
		$this->setName($methodName);
		$this->setServiceReferenceName($serviceReferenceName);
	}
	
	/**
	 * Set the service reference to use
	 * 
	 * @param $serviceReferenceName
	 * @return this
	 */
	public function setServiceReferenceName($serviceReferenceName = null){
		$this->_serviceReferenceName = $serviceReferenceName;
		return $this;
	}
	
	/**
	 * Return the name of the service reference
	 * @return string
	 */
	public function getServiceReferenceName(){
		return $this->_serviceReferenceName;
	}
}
?>
