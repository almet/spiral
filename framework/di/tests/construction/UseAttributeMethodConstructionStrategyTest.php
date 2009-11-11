<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\definition;
use spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for service construction strategy
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class UseAttributeMethodConstructionStrategyTest extends \PHPUnit_Framework_TestCase{

	protected $_container;
	protected $_currentService;

	public function setUp(){
		$this->_container = new fixtures\construction\MockContainer();
		$this->_currentService = new \stdClass();
	}

    public function testBuildServiceWithConstructor(){
		// a service construct himself by calling the construct method, and inject all properties, after that.
		// here, we just have to check that all mocks methods are called
		$mockService = new fixtures\definition\MockService();
		$mockConstructor = new fixtures\definition\MockMethod('__construct');
		$otherMethod = new fixtures\definition\MockMethod();
	}

}
?>
