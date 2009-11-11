<?php
namespace spiral\framework\di\construction;

use \spiral\framework\di\definition;
use \spiral\framework\di\fixtures;

require_once('PHPUnit/Framework.php');

/**
 * Test file for aliases construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class AttributeMethodConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildMethod(){
		$value = new fixtures\definition\MockArgument('value');
		$value->setConstructionStrategy(new fixtures\construction\MockArgumentConstructionStrategy());
		
		$method = new definition\AttributeMethod('attribute', $value);

		$strategy = new AttributeMethodConstructionStrategy();
		$strategy->setMethod($method);
		
		$object = new \stdClass();

		$container = new fixtures\construction\MockContainer();
		
		$strategy->buildMethod($container, $object);

		$this->assertObjectHasAttribute('attribute', $object);
		$this->assertSame($value, $object->attribute);
	}
}
?>
