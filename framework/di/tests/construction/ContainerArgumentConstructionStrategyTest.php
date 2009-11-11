<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;
use \spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "container argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ContainerArgumentConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildArgument(){		
		$argument = new definition\ContainerArgument();

		$strategy = new ContainerArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$container = new fixtures\construction\MockContainer();
		
		$object = new \stdClass();

		$buildedArgument = $strategy->buildArgument($container, $object);

		$this->assertSame($container, $buildedArgument);
	}
}
?>
