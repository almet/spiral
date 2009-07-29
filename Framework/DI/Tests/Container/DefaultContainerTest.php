<?php

namespace Spiral\Framework\DI\Container\Tests;

use \Spiral\Framework\DI\Container\DefaultContainer;
use \Spiral\Framework\DI\Schema\Builder\XMLBuilder;

require_once('PHPUnit/Framework.php');

/**
 * Test the DI container default implementation : DefaultContainer
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class DefaultContainerTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Container that will be tested.
	 * 
	 * The implementation concerned by this test case is DefaultContainer.
	 * 
	 * @var	\Spiral\Framework\DI\Container\DefaultContainer
	 */
	protected $_container = null;
	
	/**
	 * Set up the container to be tested.
	 *
	 * See the XML file schema configuration to know the services contained by the container.
	 * @see		Fixtures/Schema/XML/Test.xml
	 * 
	 * @return	void
	 */
	public function setUp()
	{
		// Build the schema from an XML file
		// FIXME : Is it a good solution ?
		$xmlBuilder = new XMLBuilder();
		$xmlBuilder->setFileName(FIXTURES_PATH . '/Schema/XML/Test.xml');
		$schema = $xmlBuilder->buildSchema();

		// Set up the container to be tested
		$this->_container = new DefaultContainer($schema);
	}
	
	/**
	 * Test if the hasService() and __isset() method works well when the service exists.
	 * 
	 * @return	void
	 */
	public function testHasExistingService()
	{
		$this->_container->hasService();
	}
	
	/**
	 * Test if the hasService() and __isset() method works well when the service does not exist.
	 * 
	 * @return	void
	 */
	public function testHasUnknownService()
	{
		$this->_container->has;
	}
	
	public function testGetService()
	{
		$buildedService_test = $container->getService('test');
		$test_injectedParams = $buildedService_test->getInjectedParams();
		
		$this->assertEquals('string', $test_injectedParams[0]);
		$this->assertEquals(23, $test_injectedParams[1]);
		$this->assertEquals($container->service1, $test_injectedParams[2]);
		$this->assertEquals('configParam', $test_injectedParams[3]);
		$this->assertEquals('with no argument', $test_injectedParams[4]);
		
		// check if the container itself has been injected
		$containerAware = $container->getService('containerAware');
		$this->assertEquals('SpiralDi_Container_Default', get_class($containerAware->getDiContainer()));
		
		// check if the container itself has been injected
		$containerAware = $container->getService('serviceWithContainer');
		$this->assertEquals('SpiralDi_Container_Default', get_class($containerAware->getDiContainer()));
		
		// check if the inherited service call all parent defined methods
		$inheritedService = $container->inheritedService;
		$inheritedService_injectedParams = $inheritedService->getInjectedParams();
		$this->assertEquals('string', $inheritedService_injectedParams[0]);
		$this->assertEquals(23, $inheritedService_injectedParams[1]);
		$this->assertEquals($container->service1, $inheritedService_injectedParams[2]);
		$this->assertEquals('configParam', $inheritedService_injectedParams[3]);
		$this->assertEquals('with no argument', $inheritedService_injectedParams[4]);
		
		// and that the new method has been called
		$this->assertEquals('injectedChildParam', $inheritedService->getChildMethodArgs());
		
		// check that calling an inexistant service throws an exception
		try
		{
			$container->brokenDependencyService;
			$this->fail('the SpiralDi_Schema_Exception_UnknownService Exception has not been throwed');
		}
		catch(SpiralDi_Schema_Exception_UnknownService $e)
		{
			$this->assertTrue(true);
		}
		
		try
		{
			// now, inject the container with the inexistantService
			$container->setService('inexistantService', new DiTest_InexistantService);
			$container->brokenDependencyService;
			$this->assertTrue(true);
		}
		catch(SpiralDi_Schema_Exception_UnknownService $e)
		{
			$this->fail('registering a new service on the fly in the container doesnt works');
		}
		
		$serviceFactory = $container->serviceFactory;
		$this->assertEquals('DiTest_Service1', get_class($serviceFactory));
	}
	
	public function testScopes()
	{
		$container = $this->getContainer();
		new 
		
		// by default, scope is singleton
		$this->assertTrue($container->test === $container->test);
		
		// if the scope is "prototype", objects are not strictly equals
		$this->assertFalse($container->prototype === $container->prototype);
	}
	
	public function testFactoriesScopes()
	{
		$container = $this->getContainer();
		
		// by default, scope is prototype for factories
		$this->assertFalse($container->prototypeFactory === $container->prototypeFactory);
		
		// test singleton factories
		$this->assertTrue($container->singletonFactory === $container->singletonFactory);
	}
	
	public function testIsset()
	{
		$container = $this->getContainer();
		$this->assertTrue(isset($container->test));
		$this->assertFalse(isset($container->unexistingService));
		
		$container->setService('unexistingService', new DiTest_Test());
		$this->assertTrue(isset($container->unexistingService));
	}
}
