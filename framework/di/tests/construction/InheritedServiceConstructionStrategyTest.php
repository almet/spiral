<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\InheritedService;
use spiral\framework\di\construction\InheritedServiceConstructionStrategy;

/**
 * Test file for inherited construction strategy
 * 
 * @author  	Alexis Métaireau	19 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class InheritedServiceConstructionStrategyTest extends TestCase
{

	/**
	 * Check that the strategy use methods from child and parent
	 * services, and create the object thanks to the parent service class name.
	 */
    public function testBuildServiceWithoutConflicts()
	{
		$parent = $this->_getMockService('\stdClass','parent');
		$parentMethod1 = $this->_getMockMethod('method1');
		$parentMethod1CS = $this->_getMockMethodConstructionStrategy();
		$parentMethod1->setConstructionStrategy($parentMethod1CS);
		$parent->addMethod($parentMethod1);

		$child = new InheritedService('child', 'parent');
		$childMethod2 = $this->_getMockMethod('method2');
		$childMethod2CS = $this->_getMockMethodConstructionStrategy();
		$childMethod2->setConstructionStrategy($childMethod2CS);
		$child->addMethod($childMethod2);

		$this->_schema->addService($parent);

		$strategy = new InheritedServiceConstructionStrategy();
		$strategy->setService($child);
		
		$object = $strategy->buildService($this->_schema, $this->_container);

		$this->assertEquals('stdClass', get_class($object));
		$this->assertAttributeContains($this->_container,'buildMethodCalledWith', $parentMethod1CS);
		$this->assertAttributeContains($object,'buildMethodCalledWith', $parentMethod1CS);
		$this->assertAttributeContains($this->_container,'buildMethodCalledWith', $childMethod2CS);
		$this->assertAttributeContains($object,'buildMethodCalledWith', $childMethod2CS);
	}

	/**
	 * Check that the strategy use the right method when a method name in child
	 * service overwrite the parent one.
	 */
	public function testBuildServiceWithConflicts()
	{
		$parent = $this->_getMockService('\stdClass','parent');
		$parentMethod1 = $this->_getMockMethod('method1');
		$parentMethod1CS = $this->_getMockMethodConstructionStrategy();
		$parentMethod1->setConstructionStrategy($parentMethod1CS);
		$parent->addMethod($parentMethod1);

		$child = new InheritedService('child', 'parent');
		$childMethod1 = $this->_getMockMethod('method1');
		$childMethod1CS = $this->_getMockMethodConstructionStrategy();
		$childMethod1->setConstructionStrategy($childMethod1CS);
		$child->addMethod($childMethod1);

		$this->_schema->addService($parent);

		$strategy = new InheritedServiceConstructionStrategy();
		$strategy->setService($child);

		$object = $strategy->buildService($this->_schema, $this->_container);

		$this->assertEquals('stdClass', get_class($object));
		$this->assertAttributeNotcontains($this->_container,'buildMethodCalledWith', $parentMethod1CS);
		$this->assertAttributeNotcontains($object,'buildMethodCalledWith', $parentMethod1CS);
		$this->assertAttributeContains($this->_container,'buildMethodCalledWith', $childMethod1CS);
		$this->assertAttributeContains($object,'buildMethodCalledWith', $childMethod1CS);
	}

	/**
	 * Checks that parent child method constructor is called when both are
	 * defined
	 */
	public function testBuildServiceWithConstructorConflicts()
	{
		$parent = $this->_getMockService('\UnexistantClass','parent');

		$child = new InheritedService('child', 'parent', '\stdClass');
		
		$this->_schema->addService($parent);

		$strategy = new InheritedServiceConstructionStrategy();
		$strategy->setService($child);

		$object = $strategy->buildService($this->_schema, $this->_container);

		$this->assertEquals('stdClass', get_class($object));
	}

	
}
?>
