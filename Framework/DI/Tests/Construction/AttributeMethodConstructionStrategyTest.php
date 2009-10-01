<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;
use \Spiral\Framework\DI\Fixtures;

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
		$value = new Fixtures\Definition\MockArgument('value');
		$value->setConstructionStrategy(new Fixtures\Construction\MockArgumentConstructionStrategy());
		
		$method = new Definition\AttributeMethod('attribute', $value);

		$strategy = new AttributeMethodConstructionStrategy();
		$strategy->setMethod($method);
		
		$object = new \stdClass();

		$container = new Fixtures\Construction\MockContainer();
		
		$strategy->buildMethod($container, $object);

		$this->assertObjectHasAttribute('attribute', $object);
		$this->assertSame($value, $object->attribute);
	}
}
?>
