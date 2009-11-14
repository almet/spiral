<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\ServiceReferenceArgument;
use spiral\framework\di\definition\exception\UnknownserviceException;
use spiral\framework\di\construction\ServiceReferenceArgumentConstructionStrategy;

/**
 * Test file for service reference construction strategy
 * 
 * @author  	Alexis Métaireau	13 nov. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class ServiceReferenceArgumentConstructionStrategyTest extends TestCase
{

	/**
	 * Test that argument reference construction strategy relies and delegate
	 * the construction of the service to the container
	 */
    public function testBuildServiceWithConstructor()
	{
		$ref = new ServiceReferenceArgument('service');

		$strategy = new ServiceReferenceArgumentConstructionStrategy();
		$strategy->setArgument($ref);

		try
		{
			$strategy->buildArgument($this->_container, $object);
		}
		catch(UnknownserviceException $e){}
		
		$this->assertAttributeContains('service','getServiceArguments', $this->_container);
	}

}
?>
