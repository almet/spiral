<?php
namespace Spiral\Framework\DI\Construction;

use Spiral\Framework\DI\Definition;
use Spiral\Framework\DI\Fixtures;

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
		$this->_container = new Fixtures\Construction\MockContainer();
		$this->_currentService = new \stdClass();
	}

    public function testBuildService(){
		$baseService = new Definition\DefaultService('store','Spiral\Framework\DI\Tests\Fixtures\Definition\Store');

		$constructor = new Definition\DefaultMethod('__construct');
		$arg1 = new Definition\DefaultArgument('injectedArgument');
		$inheritedService = new Definition\InheritedService('musicStore', 'store', 'Spiral\Framework\DI\Tests\Fixtures\Definition\MusicStore');


	}

}
?>
