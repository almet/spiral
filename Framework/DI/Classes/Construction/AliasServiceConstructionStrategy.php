<?php
namespace Spiral\Framework\DI\Construction;
use Spiral\Framework\DI\Definition;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class AliasServiceConstructionStrategy  extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	\Spiral\Framework\DI\Definition\Schema
	 * @param	\Spiral\Framework\DI\Construction\Container
	 * @return 	object	builded service, with all injected methods and arguments
	 */
	public function buildService(Definition\Schema $schema, Construction\Container $container){
		return $this->schema->getService($this->getService()->getServiceName())
			->getConstructionStrategy()->buildService($schema, $container);
	}
}
?>
