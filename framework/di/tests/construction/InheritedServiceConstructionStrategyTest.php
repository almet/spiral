<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\definition;
use spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for inherited construction strategy
 * 
 * @author  	Alexis Métaireau	19 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class InheritedServiceConstructionStrategyTest extends \PHPUnit_Framework_TestCase{

	protected $_container;
	protected $_currentService;

	public function setUp(){
		$this->_container = new fixtures\construction\MockContainer();
		$this->_currentService = new \stdClass();
	}

    public function testBuildService(){
		$baseService = new definition\DefaultService('store','spiral\framework\di\Tests\fixtures\definition\Store');

		$constructor = new definition\DefaultMethod('__construct');
		$arg1 = new definition\DefaultArgument('injectedArgument');
		$inheritedService = new definition\InheritedService('musicStore', 'store', 'spiral\framework\di\Tests\fixtures\definition\MusicStore');


	}

}
?>
