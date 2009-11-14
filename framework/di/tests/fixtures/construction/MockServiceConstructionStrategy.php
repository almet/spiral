<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractServiceConstructionStrategy;
use spiral\framework\di\construction\ServiceConstructionStrategy;
use spiral\framework\di\construction\Container;
use spiral\framework\di\definition\Schema;

/**
 * Mock service construction Strategy
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockServiceConstructionStrategy extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy
{
	public $buildServiceArguments = array();
	public function buildService(Schema $schema,Container $container)
	{
		$this->buildServiceArguments = array($schema, $container);
		return $this->getService();
	}
}
?>
