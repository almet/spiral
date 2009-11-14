<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\ContainerArgument;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "container argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ContainerArgumentConstructionStrategyTest extends TestCase
{

	/**
	 * Check out that the container argument construction strategy
	 * return the container given in parameter.
	 */
    public function testBuildArgument()
	{
		$argument = new ContainerArgument();
		$container = $this->_getMockContainer();

		$strategy = new ContainerArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$object = new \stdClass();

		$buildedArgument = $strategy->buildArgument($container, $object);

		$this->assertSame($container, $buildedArgument);
	}
}
?>
