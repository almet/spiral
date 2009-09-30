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

class AliasServiceConstructionStrategyTest extends \PHPUnit_Framework_TestCase{
    public function testBuildService(){
		// build alias service mock
		$aliasService = new Fixtures\Definition\MockService();
		$aliasService->setName('mockService');

		$schema = new Fixtures\Definition\MockSchema();

		// schema mock
		$container = new Fixtures\Construction\MockContainer();

		//check that calling alias service returns our mock
		$strategy = new AliasServiceConstructionStrategy();
		$strategy->setService($aliasService);

		$this->assertEquals($strategy->buildService($schema, $container)->getName(), 'mockService');
		$this->assertFalse($schema === $strategy->buildService($schema, $container));
	}
}
?>
