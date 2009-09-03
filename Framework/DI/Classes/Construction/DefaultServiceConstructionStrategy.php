<?php
namespace Spiral\Framework\DI\Construction;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
class DefaultServiceConstructionStrategy  extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * return default argument
	 * 
	 * @return 	string	builded service
	 */
	public function buildService(){
		return '';
	}
}
?>
