<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Method Construction Strategy that use an attribute
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class AttributeMethodConstructionStrategy extends AbstractMethodConstructionStrategy implements MethodConstructionStrategy
{
	/**
	 * call the method and return the result
	 * 
	 * @param	\Spiral\Framework\DI\Construction\Container container of services
	 * @param	object	current processed service
	 * @return 	mixed
	 */
	public function buildMethod(Container $container, $currentService = null){
		$method = $this->getMethod();
		$attribute = $method->getName();
		$value = $method->getArgument(0)->buildArgument($container, $currentService);
		
		$currentService->$attribute = $value;
	}
}
?>
