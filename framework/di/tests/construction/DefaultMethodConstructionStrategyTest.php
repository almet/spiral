<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\definition;
use spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for constructor method construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class DefaultMethodConstructionStrategyTest extends \PHPUnit_Framework_TestCase{

	protected $_container;
	protected $_currentService;
	protected $_album;
	protected $_year;
	protected $_support;

	public function setUp(){
		$this->_container = new fixtures\construction\MockContainer();
		$this->_currentService = new \stdClass();

		$this->_album = new definition\DefaultArgument('Please Please Please');
		$this->_album->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());

		$this->_year = new definition\DefaultArgument('2004');
		$this->_year->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());

		$this->_support = new definition\DefaultArgument('support');
		$this->_support->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());
	}

	/**
	 * Test static method calls
	 */
    public function testBuildStaticMethod(){
		$method = new definition\DefaultMethod('create', '\spiral\framework\di\fixtures\StaticAlbumFactory');
		
		$method->addArgument($this->_album);
		$method->addArgument($this->_year);
		$method->addArgument($this->_support);

		$strategy = new DefaultMethodConstructionStrategy();
		$strategy->setMethod($method);

		$buildedMethod = $strategy->buildMethod($this->_container, $this->_currentService);

		// tests
		$this->assertObjectHasAttribute('name', $buildedMethod);
		$this->assertObjectHasAttribute('year', $buildedMethod);
		$this->assertObjectHasAttribute('support', $buildedMethod);

		$this->assertSame($this->_album, $buildedMethod->name);
		$this->assertSame($this->_year, $buildedMethod->year);
		$this->assertSame($this->_support, $buildedMethod->support);
	}

	public function testBuildMethod(){
		$method = new definition\DefaultMethod('setName');
		$method->addArgument($this->_album);

		$store = new fixtures\Store();

		$strategy = new DefaultMethodConstructionStrategy();
		$strategy->setMethod($method);

		$strategy->buildMethod($this->_container, $store);

		// tests
		$this->assertObjectHasAttribute('name', $store);
		$this->assertSame($this->_album, $store->name);
	}

	/**
	 * @expectedException \spiral\framework\di\construction\Exception\InvalidMethod
	 */
	public function testInvalidMethod(){
		$strategy = new DefaultMethodConstructionStrategy();
		$strategy->setMethod(new fixtures\definition\MockMethod());
		
		$strategy->buildMethod($this->_container, $this->_currentService);
	}
}
?>
