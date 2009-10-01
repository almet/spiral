<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;
use \Spiral\Framework\DI\Fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "constructor argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ContainerArgumentConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildArgument(){		
		$argument = new Definition\ContainerArgument();

		$strategy = new ContainerArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$container = new Fixtures\Construction\MockContainer();
		
		$object = new \stdClass();

		$buildedArgument = $strategy->buildArgument($container, $object);

		$this->assertSame($container, $buildedArgument);
	}
}
?>
