<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Default Method Construction Strategy
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class DefaultMethodConstructionStrategy extends AbstractMethodConstructionStrategy implements MethodConstructionStrategy
{
	
	/**
	 * return builded method
	 * 
	 * @return 	string	builded method
	 */
	public function buildMethod(){
		return $this->getMethod();
	}
}
?>
