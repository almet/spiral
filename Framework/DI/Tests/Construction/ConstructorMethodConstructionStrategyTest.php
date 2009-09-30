<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;
use \Spiral\Framework\DI\Fixtures;

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
		$album = new Definition\DefaultArgument('Please Please Please');
		$album->setConstructionStrategy(new Fixtures\Construction\MockArgumentConstructionStrategy());
		
		$year = new Definition\DefaultArgument('2004');
		$year->setConstructionStrategy(new Fixtures\Construction\MockArgumentConstructionStrategy());

		$support = new Definition\DefaultArgument('support');
		$support->setConstructionStrategy(new Fixtures\Construction\MockArgumentConstructionStrategy());

		$method = new Definition\DefaultMethod('__construct', '\Spiral\Framework\DI\Fixtures\Album');
		$method->addArgument($album);
		$method->addArgument($year);
		$method->addArgument($support);

		$strategy = new ConstructorMethodConstructionStrategy();
		$strategy->setMethod($method);

		$object = new \stdClass();
		$container = new Fixtures\Construction\MockContainer();
		
		$buildedService = $strategy->buildMethod($container, $object);

		$this->assertAttributeEquals($album, 'name', $buildedService);
		$this->assertAttributeEquals($year, 'year', $buildedService);
		$this->assertAttributeEquals($support, 'support', $buildedService);
	}
}
?>
