<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\definition\Schema;

/**
 * Abstract Service Construction Strategy
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class AliasServiceConstructionStrategy  extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy
{	
	/**
	 * Default service builder strategy
	 * 
	 * @param	Schema
	 * @param	Container
	 * @return 	object	Builded service, with all injected methods and arguments
	 */
	public function buildService(Schema $schema, Container $container)
	{
		$alias = $this->getService()->getAlias();
		return $container->getService($alias);
	}
}
