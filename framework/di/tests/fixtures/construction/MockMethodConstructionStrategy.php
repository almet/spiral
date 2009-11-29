<?php

namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractMethodConstructionStrategy;
use spiral\framework\di\construction\MethodConstructionStrategy;
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

class MockMethodConstructionStrategy extends AbstractMethodConstructionStrategy implements MethodConstructionStrategy
{
	public $buildMethodCalledWith = array();
	
	public function buildMethod(Container $container,$currentService = null)
	{
		$this->buildMethodCalledWith = array($container, $currentService);
		return null;
	}
}
?>
