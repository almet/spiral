<?php
namespace Spiral\Framework\DI\Construction;

use Spiral\Framework\DI\Definition;
use Spiral\Framework\DI\Fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for service construction strategy
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ServiceReferenceMethodConstructionStrategyTest extends \PHPUnit_Framework_TestCase{

	protected $_container;
	protected $_currentService;

	public function setUp(){
		$this->_container = new Fixtures\Construction\MockContainer();
		$this->_currentService = new \stdClass();
	}

    public function testBuildServiceWithConstructor(){
		// a service construct himself by calling the construct method, and inject all properties, after that.
		// here, we just have to check that all mocks methods are called
		$mockService = new Fixtures\Definition\MockService();
		$mockConstructor = new Fixtures\Definition\MockMethod('__construct');
		$otherMethod = new Fixtures\Definition\MockMethod();
	}

}
?>
