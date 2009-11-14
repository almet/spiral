<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractArgumentConstructionStrategy;
use spiral\framework\di\construction\ArgumentConstructionStrategy;
use spiral\framework\di\construction\Container;
use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\Service;

/**
 * Mock service construction Strategy
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy implements ArgumentConstructionStrategy
{
	public $buildArgumentArguments = array();
	
	public function buildArgument(Container $container,$currentService)
	{
		$this->buildArgumentArguments = array($container, $currentService);
		return $this->getArgument();
	}
}
?>
