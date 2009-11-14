<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\fixtures\Collection;
use spiral\framework\di\definition\UseReferenceArgument;
use spiral\framework\di\construction\UseReferenceArgumentConstructionStrategy;

/**
 * Test file for service construction strategy
 * 
 * @author  	Alexis Métaireau	01 oct. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class UseReferenceArgumentConstructionStrategyTest extends TestCase
{

	/**
	 * We have a service defined, in the container, and we want to use one of
	 * this method and inject the result as an argument for another service.
	 *
	 * Tests if the construction strategies try to get the object via the
	 * container, and if it's return the value passed by the container
	 */
    public function testBuildServiceWithConstructor()
	{
		$collection = new Collection();
		$collection->setElement('element', 'value');
		$this->_container->addSharedService('collection', $collection);

		$argument = new UseReferenceArgument('collection', 'getElement', 'element');
		$strategy = new UseReferenceArgumentConstructionStrategy();
		$strategy->setArgument($argument);

		$returnedValue = $strategy->buildArgument($this->_container, $this->_object);

		$this->assertEquals('value', $returnedValue);
	}
}
?>
