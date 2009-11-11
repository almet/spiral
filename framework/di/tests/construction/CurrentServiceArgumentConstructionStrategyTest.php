<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;
use \spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "current service argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class CurrentServiceArgumentConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildArgument(){		
		$argument = new definition\CurrentServiceArgument();

		$strategy = new CurrentServiceArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$container = new fixtures\construction\MockContainer();
		
		$object = new \stdClass();
		$object->godfatherOfSaoul = 'JB';

		$buildedArgument = $strategy->buildArgument($container, $object);

		$this->assertSame($object, $buildedArgument);
	}
}
?>
