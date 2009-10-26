<?php

namespace spiral\framework\di\construction;

/**
 * Callback Method Construction Strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class CallbackMethodConstructionStrategy extends AbstractMethodConstructionStrategy
{
	/**
	 * Call the method and return the result
	 * 
	 * @param	Container 	Container of services
	 * @param	object		Current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, $currentService = null)
	{
		$this->getMethod()->getMethod()->getConstructionStrategy()->buildMethod($container, $currentService);
	}
}
