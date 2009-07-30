<?php
namespace Spiral\Framework\DI\Construction;

use \SpiralFramework\DI\Schema;

/**
 * Chain of responsability pattern used to resolve how 
 * argument had to be built
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class ArgumentChainResolver
{
	/**
	 * Set the next resolver of the chain
	 * 
	 * @param	\Spiral\Framework\DI\Construction\ArgumentResolver	$next
	 * @return	\Spiral\Framework\DI\Construction\ArgumentResolver
	 */
	public function setNext(ArgumentResolver $next)
	{
		$this->_next = $next;
		return $next;	
	}
	
	/**
	 * Resolve the argument or call next resolver of the chain
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument		$argument
	 * @param	\Spiral\Framework\DI\Construction\Container	$container
	 * @param	Object										$currentService	
	 * @return 	mixed
	 */
	public function resolve(Schema\Argument $argument, Container $container, $currentService)
	{
		$resolvedArgument = $this->_resolveArgument($argument, $container, $currentService);
		
		if($resolvedArgument === false && $this->_next !== null)
		{
			return $this->_next->resolve($argument, $container, $currentService);	
		}
		
		return $resolvedArgument;
	}
	
	/**
	 * Do what is needed with the given arguments, and return the resolved argument
	 * 
	 * @param 	\Spiral\Framework\DI\Definition\Argument		$argument
	 * @param	\Spiral\Framework\DI\Construction\Container	$container
	 * @param	Object										$currentService
	 * @return 	mixed
	 */
	abstract protected function _resolveArgument(Schema\Argument $argument, Container $container, $currentService);
}