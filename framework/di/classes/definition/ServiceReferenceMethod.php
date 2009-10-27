<?php

namespace spiral\framework\di\definition;

/**
 * Use a service method
 *
 * See the interface for further information.
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
	 * Construct a method and set its name
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
	 * @param	string	$serviceReferenceName
	 * @return	Method
	 */
	public function setServiceReferenceName($serviceReferenceName = null)
	{
		$this->_serviceReferenceName = $serviceReferenceName;
		return $this;
	}
	
	/**
	 * Return the name of the service reference
	 * 
	 * @return string
	 */
	public function getServiceReferenceName()
	{
		return $this->_serviceReferenceName;
	}
}
