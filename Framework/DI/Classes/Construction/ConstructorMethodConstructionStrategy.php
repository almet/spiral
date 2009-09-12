<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;
/**
 * Method Construction Strategy for constructors
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class ConstructorMethodConstructionStrategy extends AbstractMethodConstructionStrategy implements MethodConstructionStrategy
{
	
	/**
	 * Build object from it's constructor
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container container of services
	 * @param	object	current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, object $currentService = null){
		
		$constructor = $this->getMethod();
		$className = $constructor->getClassName(); 
		
		// init array
		$argumentArray = array();
		
		foreach($constructor->getArguments() as $argument){
			$argumentArray[] = $argument->getConstructionStrategy()->buildArgument($container, $currentService);	
		}
		
		$service = call_user_func_array(array($className, '__construct'), $arguments);
		
		return $service;
	}
}
?>