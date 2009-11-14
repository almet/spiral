<?php
namespace spiral\framework\di\fixtures\definition;

use spiral\framework\di\definition\DefaultService;
use spiral\framework\di\fixtures\construction\MockServiceConstructionStrategy;

/**
 * Mock service used in tests
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockService extends DefaultService
{
	public function __construct()
	{
		//parent::__construct($service, $class);
		$this->setConstructionStrategy(new MockServiceConstructionStrategy());
	}

	public function setClassName($className)
	{
		$this->_className = $className;
	}
}
?>
