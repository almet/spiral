<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Resolve the default argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class DefaultArgumentConstructionStrategy extends AbstractArgumentStrategy
{	
	/**
	 * return default argument
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container	$container		
	 * @param	object										$currentService		current active service
	 * @return 	string	builded argument
	 */
	public function buildArgument(Container $container, object $currentService)
	{
		return $this->getArgument()->getValue();
	}
}