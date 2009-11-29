<?php

namespace spiral\framework\di\construction;

use \spiral\framework\di\TestCase;
use \spiral\framework\di\definition\DefaultArgument;
use \spiral\framework\di\definition\DefaultMethod;

require_once('PHPUnit/Framework.php');

/**
 * Test file for constructor method construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ConstructorMethodConstructionStrategyTest extends TestCase
{

	/**
	 * Test that the services are well build, and that argument construction
	 * strategies are called
	 */
    public function testBuildMethod()
	{
		$strategy1 = $this->_getMockArgumentConstructionStrategy();
		$strategy2 = $this->_getMockArgumentConstructionStrategy();
		$strategy3 = $this->_getMockArgumentConstructionStrategy();
		
		$album = new DefaultArgument('Please Please Please');
		$album->setConstructionStrategy($strategy1);
		
		$year = new DefaultArgument('2004');
		$year->setConstructionStrategy($strategy2);

		$support = new DefaultArgument('support');
		$support->setConstructionStrategy($strategy3);

		$method = new DefaultMethod('__construct', '\spiral\framework\di\fixtures\Album');
		$method->addArgument($album);
		$method->addArgument($year);
		$method->addArgument($support);

		$strategy = new ConstructorMethodConstructionStrategy();
		$strategy->setMethod($method);

		$object = new \stdClass();
		$container = $this->_getMockContainer();
		
		$buildedService = $strategy->buildMethod($container, $object);

		// for each param, check that construction strategies are called
		foreach (array($strategy1, $strategy2, $strategy3) as $strategy)
		{
			$this->assertAttributeContains($container, 'buildArgumentArguments', $strategy);
			$this->assertAttributeContains($object, 'buildArgumentArguments', $strategy);
		}

		// and that the service is build properly
		$this->assertEquals('spiral\framework\di\fixtures\Album', get_class($buildedService));
	}
}
?>
