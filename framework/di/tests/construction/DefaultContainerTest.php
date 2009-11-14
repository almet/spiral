<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\construction\DefaultContainer;
use spiral\framework\di\definition\DefaultSchema;

/**
 * Test the DI container default implementation : DefaultContainer
 * 
 * @author	Alexis Metaireau <alexis@spiral-project.org>
 */
class DefaultContainerTest extends TestCase
{
	/**
	 * Check that when we call a service, the container delegate the build
	 * to the construction strategies
	 */
	public function testGetService()
	{
		$strategy = $this->_getMockServiceConstructionStrategy();
		$service = $this->_getMockService('\stdClass','service');
		$service->setConstructionStrategy($strategy);
		
		$schema = $this->_getMockSchema();
		$schema->addService($service);

		$container = new DefaultContainer($schema);
		$container->getService('service');
		
		$this->assertAttributeContains($schema, 'buildServiceArguments', $strategy);
		$this->assertAttributeContains($container, 'buildServiceArguments', $strategy);
	}
}
