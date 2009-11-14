<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\definition;
use spiral\framework\di\fixtures;
use spiral\framework\di\TestCase;

require_once('PHPUnit/Framework.php');

/**
 * Test file for service construction strategy
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class DefaultServiceConstructionStrategyTest extends TestCase
{

	/**
	 * Check that the construction strategy create objects when no constructor
	 * method is defined.
	 */
    public function testBuildServiceWithoutConstructor()
	{
		$service = $this->_getMockService('\stdClass');

		$constructionStrategy = new DefaultServiceConstructionStrategy();
		$constructionStrategy->setService($service);
		$object = $constructionStrategy->buildService($this->_getMockSchema(), $this->_getMockContainer());

		$this->assertEquals('stdClass', get_class($object));
	}

	/**
	 * Checks that the construction strategy delegate on method construction
	 * strategy when a constructor is defined.
	 */
	public function testBuildServiceWithConstructor()
	{
		$service = $this->_getMockService('\spiral\framework\di\fixtures\Store');
		$constructor = $this->_getMockMethod('__construct');

		$strategy = $this->_getMockMethodConstructionStrategy();
		$container = $this->_getMockContainer();
		$constructor->setConstructionStrategy($strategy);

		$service->addMethod($constructor);

		$constructionStrategy = new DefaultServiceConstructionStrategy();
		$constructionStrategy->setService($service);
		$object = $constructionStrategy->buildService($this->_getMockSchema(), $container);

		$this->assertNull($object);
		$this->assertAttributeContains($container, 'buildMethodCalledWith', $strategy);
	}

	/**
	 * Checks that the construction strategy call all method construction
	 * strategies, passing their the right initialized object
	 */
	public function testBuildServiceWithArguments()
	{
		// get mocks
		$service = $this->_getMockService('\stdClass');
		$container = $this->_getMockContainer();
		$schema = $this->_getMockSchema();
		$strategy = $this->_getMockMethodConstructionStrategy();

		// create the service
		$constructionStrategy = new DefaultServiceConstructionStrategy();
		$constructionStrategy->setService($service);

		// create and add methods to the service
		$method = $this->_getMockMethod('myMethod');
		$method->setConstructionStrategy($strategy);
		$service->addMethod($method);

		// call to the method
		$object = $constructionStrategy->buildService($schema, $container);

		$this->assertEquals('stdClass', get_class($object));
		$this->assertAttributeContains($container, 'buildMethodCalledWith', $strategy);
		$this->assertAttributeContains($object, 'buildMethodCalledWith', $strategy);
	}

}
?>
