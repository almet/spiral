<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\construction\exception\InvalidMethod;
use \spiral\framework\di\definition\DefaultMethod;

/**
 * Default Method Construction Strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultMethodConstructionStrategy extends AbstractMethodConstructionStrategy
{
	/**
	 * Call the method and return the result
	 * 
	 * @param	Container	Container of services
	 * @param	object		Current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, $currentService = null)
	{
		$method = $this->getMethod();
		if(!$method instanceof DefaultMethod)
		{
			throw new InvalidMethod(get_class($method));
		}

		if($method->isStatic())
		{
			$callback = $method->getClassName();
		}
		else
		{
			$callback = $currentService;
		}
		$methodName = $method->getName();

		$arguments = array();
		foreach($method->getArguments() as $argument)
		{
			$arguments[] = $argument->buildArgument($container, $currentService);
		}

		if(method_exists($callback, $methodName) && is_callable(array($callback, $methodName)))
		{
			$object = call_user_func_array(array($callback, $methodName), $arguments);
			return $object;
		}
	}
}
