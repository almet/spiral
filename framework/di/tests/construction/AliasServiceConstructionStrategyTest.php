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

class AliasServiceConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildService(){
		// build alias service mock
		$aliasService = new fixtures\definition\MockService();
		$aliasService->setName('mockService');

		$schema = new fixtures\definition\MockSchema();

		// schema mock
		$container = new fixtures\construction\MockContainer();

		//check that calling alias service returns our mock
		$strategy = new AliasServiceConstructionStrategy();
		$strategy->setService($aliasService);

		$buildedService = $strategy->buildService($schema, $container);

		$this->assertEquals($buildedService->getName(), 'mockService');
		$this->assertNotSame($aliasService,$buildedService);
	}
}
?>
