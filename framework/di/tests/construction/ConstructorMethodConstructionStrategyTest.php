<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;
use \spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for constructor method construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ConstructorMethodConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildMethod(){
		$album = new definition\DefaultArgument('Please Please Please');
		$album->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());
		
		$year = new definition\DefaultArgument('2004');
		$year->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());

		$support = new definition\DefaultArgument('support');
		$support->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());

		$method = new definition\DefaultMethod('__construct', '\spiral\framework\di\fixtures\Album');
		$method->addArgument($album);
		$method->addArgument($year);
		$method->addArgument($support);

		$strategy = new ConstructorMethodConstructionStrategy();
		$strategy->setMethod($method);

		$object = new \stdClass();
		$container = new fixtures\construction\MockContainer();
		
		$buildedService = $strategy->buildMethod($container, $object);

		$this->assertSame($album, $buildedService->name);
		$this->assertSame($year, $buildedService->year);
		$this->assertSame($support, $buildedService->support);
	}
}
?>
