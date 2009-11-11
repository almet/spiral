<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;
use \spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for "default argument" construction strategies
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class DefaultArgumentConstructionStrategyTest extends \PHPUnit_Framework_TestCase{

	protected $_container;
	protected $_currentService;
	
	public function setUp(){
		$this->_container = new fixtures\construction\MockContainer();
		$this->_currentService = new \stdClass();
	}

	/**
	 * Data provider
	 *
	 * @return array
	 */
	public function provider(){
		return array(
			array((int)1, new definition\DefaultArgument(1)),
			array((string)1, new definition\DefaultArgument("1")),
			array((float)1.1, new definition\DefaultArgument(1.1)),
		);
	}
	
	/**
	 * Test method
	 * 
	 * @dataProvider	provider
	 */
    public function testBuildArgument($expected, $argument){
		$strategy = new DefaultArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$buildedArgument = $strategy->buildArgument($this->_container, $this->_currentService);

		$this->assertSame($expected, $buildedArgument);
	}
}
?>
