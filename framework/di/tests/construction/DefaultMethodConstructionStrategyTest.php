<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\DefaultArgument;
use spiral\framework\di\definition\DefaultMethod;
use spiral\framework\di\fixtures\Store;
use spiral\framework\di\fixtures\construction\MockContainer;
use spiral\framework\di\fixtures\construction\MockArgumentConstructionStrategy;
use spiral\framework\di\fixtures\definition\MockMethod;
use spiral\framework\di\fixtures\definition\OtherMethod;

require_once('PHPUnit/Framework.php');

/**
 * Test file for constructor method construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class DefaultMethodConstructionStrategyTest extends TestCase
{

	protected $_container;
	protected $_currentService;
	protected $_album;
	protected $_year;
	protected $_support;

	public function setUp()
	{
		$this->_container = $this->_getMockContainer();
		$this->_currentService = new \stdClass();

		$this->_album = new DefaultArgument('Please Please Please');
		$this->_album->setConstructionStrategy(new MockArgumentConstructionStrategy());

		$this->_year = new DefaultArgument('2004');
		$this->_year->setConstructionStrategy(new MockArgumentConstructionStrategy());

		$this->_support = new DefaultArgument('support');
		$this->_support->setConstructionStrategy(new MockArgumentConstructionStrategy());
	}

	/**
	 * Test static method calls
	 */
    public function testBuildStaticMethod()
	{
		$method = new DefaultMethod('create', '\spiral\framework\di\fixtures\StaticAlbumFactory');
		
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

	public function testBuildMethod()
	{
		$method = new DefaultMethod('setName');
		$method->addArgument($this->_album);

		$store = new Store();

		$strategy = new DefaultMethodConstructionStrategy();
		$strategy->setMethod($method);

		$strategy->buildMethod($this->_container, $store);

		// tests
		$this->assertObjectHasAttribute('name', $store);
		$this->assertSame($this->_album, $store->name);
	}

	/**
	 * 
	 * @expectedException \spiral\framework\di\construction\exception\InvalidMethod
	 */
	public function testInvalidMethod()
	{
		$strategy = new DefaultMethodConstructionStrategy();
		$strategy->setMethod(new OtherMethod());
		
		$strategy->buildMethod($this->_container, $this->_currentService);
	}
}
?>
