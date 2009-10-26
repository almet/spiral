<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Method;

/**
 * Interface for the Method Construction Strategies
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface MethodConstructionStrategy
{
	/**
	 * Setter for argument
	 * 
	 * @param 	Method	$method
	 * @return	void
	 */
	public function setMethod(Method $method);
	
	/**
	 * Getter for method
	 * 
	 * @return Method
	 */
	public function getMethod();
	
	/**
	 * Call the method and return the result
	 * 
	 * @param	Container	Container of services
	 * @param	object		Current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, $currentService = null);
}
