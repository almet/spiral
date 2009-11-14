<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\DefaultArgument;

/**
 * Test file for "default argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class DefaultArgumentConstructionStrategyTest extends TestCase
{
	protected $_container;
	protected $_currentService;
	
	public function setUp()
	{
		$this->_container = $this->_getMockContainer();
		$this->_currentService = new \stdClass();
	}

	/**
	 * Data provider
	 *
	 * @return array
	 */
	public function provider()
	{
		return array(
			array((int)1, new DefaultArgument(1)),
			array((string)1, new DefaultArgument("1")),
			array((float)1.1, new DefaultArgument(1.1)),
		);
	}
	
	/**
	 * Test that the default argument construction strategy retun right types
	 * 
	 * @dataProvider	provider
	 */
    public function testBuildArgument($expected, $argument)
	{
		$strategy = new DefaultArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$buildedArgument = $strategy->buildArgument($this->_container, $this->_currentService);

		$this->assertSame($expected, $buildedArgument);
	}
}
?>
