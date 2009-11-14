<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\definition\AliasService;
use spiral\framework\di\definition\exception\UnknownserviceException;

/**
 * Test file for aliases construction strategies
 * 
 * @author  	Alexis Métaireau	26 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class AliasServiceConstructionStrategyTest extends TestCase
{

	/**
	 * Test that aliases services build themselves by calling the aliased
	 * service
	 */
    public function testBuildService()
	{
		// build alias service mock
		$aliasStrategy = $this->_getMockServiceConstructionStrategy();
		$aliasService = new AliasService('aliasName', 'aliasedService');
		$aliasService->setConstructionStrategy($aliasStrategy);
		
		$schema = $this->_getMockSchema();
		$container = $this->_getMockContainer();

		//check that calling alias service returns our mock
		$strategy = new AliasServiceConstructionStrategy();
		$strategy->setService($aliasService);

		try
		{
			$buildedService = $strategy->buildService($schema, $container);
		}
		catch(UnknownserviceException $e)
		{
			$unknownserviceExceptionThrown = True;
		}

		$this->assertTrue($unknownserviceExceptionThrown);

		// and check that the mocked container getService method is called
		$this->assertAttributeContains('aliasName','getServiceArguments', $container);
	}
}
?>
