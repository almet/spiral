<?php
namespace spiral\framework\di;

use spiral\framework\di\fixtures\definition\MockSchema;
use spiral\framework\di\fixtures\definition\MockService;
use spiral\framework\di\fixtures\definition\MockMethod;
use spiral\framework\di\fixtures\definition\MockArgument;
use spiral\framework\di\fixtures\construction\MockContainer;
use spiral\framework\di\fixtures\construction\MockServiceConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockMethodConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockArgumentConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockAbstractConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockAbstractArgumentConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockAbstractMethodConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockAbstractServiceConstructionStrategy;
use spiral\framework\di\fixtures\construction\MockAbstractContainer;

use spiral\framework\di\fixtures\construction\MockLoader;

/**
 * Abstract test case class.
 *
 * Provides method to easily creates testcases for the DI component, by providing
 * all useful fixtures for the DI.
 *
 * @author  	Alexis Métaireau	11 nov. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

abstract class TestCase extends \PHPUnit_Framework_TestCase {
	
	protected $_schema;
	protected $_container;
	protected $_object;

	public function setUp()
	{
		$this->_schema = $this->_getMockSchema();
		$this->_container = $this->_getMockContainer();
		$this->_object = new \stdClass();
	}
	
    /**
	 * Return a mock method object
	 *
	 * @param string $methodName
	 * @return \spiral\framework\di\tests\fixtures\definition\MockMethod
	 */
	protected function _getMockMethod($methodName)
	{
		return new MockMethod($methodName);
	}

	/**
	 * Return a mock container object
	 * 
	 * @return \spiral\framework\di\tests\fixtures\definition\MockContainer
	 */
	protected function _getMockContainer()
	{
		return new MockContainer($this->_getMockSchema());
	}

	/**
	 * Return a mock schema object
	 * 
	 * @return MockSchema
	 */
	protected function _getMockSchema()
	{
		return new MockSchema();
	}

	/**
	 * Return a mock service object
	 * 
	 * @param string $className
	 * @return MockService
	 */
	protected function _getMockService($className=null, $name=null)
	{
		$service = new MockService();

		if (null !== $className)
		{
			$service->setClassName($className);
		}
		if (null !== $name)
		{
			$service->setName($name);
		}
		
		return $service;
	}

	/**
	 * Return a mock argument object
	 * 
	 * @param string $value
	 * @return MockArgument 
	 */
	protected function _getMockArgument($value)
	{
		return new MockArgument($value);
	}

	/**
	 * Return a mock method construction strategy
	 * 
	 * @return MockMethodConstructionStrategy 
	 */
	protected function _getMockMethodConstructionStrategy()
	{
		return new MockMethodConstructionStrategy();
	}

	/**
	 * Return a mock argument construction strategy object
	 * 
	 * @return MockArgumentConstructionStrategy
	 */
	protected function _getMockArgumentConstructionStrategy()
	{
		return new MockArgumentConstructionStrategy();
	}

	/**
	 * Return a mocj service construction strategy object
	 * 
	 * @return MockServiceConstructionStrategy 
	 */
	protected function _getMockServiceConstructionStrategy()
	{
		return new MockServiceConstructionStrategy();
	}

	protected function _getMockLoader()
	{
		return new MockLoader();
	}

	protected function _getMockAbstractConstructionStrategy()
	{
		return new MockAbstractConstructionStrategy();
	}

	protected function _getMockAbstractArgumentConstructionStrategy()
	{
		return new MockAbstractArgumentConstructionStrategy();
	}

	protected function _getMockAbstractMethodConstructionStrategy()
	{
		return new MockAbstractMethodConstructionStrategy();
	}

	protected function _getMockAbstractServiceConstructionStrategy()
	{
		return new MockAbstractServiceConstructionStrategy();
	}

	protected function _getMockAbstractContainer()
	{
		return new MockAbstractContainer();
	}
	
}
?>
