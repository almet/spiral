<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use \spiral\framework\di\definition\AttributeMethod;

/**
 * Test file for attribute methods construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class AttributeMethodConstructionStrategyTest extends TestCase
{
	/**
	 * Test that the argument construction strategy is called when using
	 * the attribute method construction strategy
	 */
    public function testBuildMethod()
	{
		$value = $this->_getMockArgument('value');
		$argStrategy = $this->_getMockArgumentConstructionStrategy();
		$value->setConstructionStrategy($argStrategy);
		$container = $this->_getMockContainer();
		
		$method = new AttributeMethod('attribute', $value);

		$strategy = new AttributeMethodConstructionStrategy();
		$strategy->setMethod($method);
		
		$object = new \stdClass();

		$strategy->buildMethod($container, $object);

		// check that the attribute construction strategy are called
		$this->assertAttributeContains($container, 'buildArgumentArguments', $argStrategy);
		$this->assertAttributeContains($object, 'buildArgumentArguments', $argStrategy);

		// check that the attribute is set
		$this->assertObjectHasAttribute('attribute', $object);
		$this->assertAttributeEquals($value,'attribute', $object);
		
	}
}
?>
