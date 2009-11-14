<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use \spiral\framework\di\definition\CurrentServiceArgument;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "current service argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class CurrentServiceArgumentConstructionStrategyTest extends TestCase
{

	/**
	 * Check that the current service argument construction strategy return the
	 * service given in parameter as a builded argument
	 */
    public function testBuildArgument()
	{
		$argument = new CurrentServiceArgument();
		$container = $this->_getMockContainer();

		$strategy = new CurrentServiceArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$object = new \stdClass();
		$object->godfatherOfSaoul = 'JB';

		$buildedArgument = $strategy->buildArgument($container, $object);

		$this->assertSame($object, $buildedArgument);
	}
}
?>
