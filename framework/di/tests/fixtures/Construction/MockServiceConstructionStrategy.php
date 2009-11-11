<?php
namespace Spiral\Framework\DI\Fixtures\Construction;

use Spiral\Framework\DI\Construction\AbstractServiceConstructionStrategy;
use Spiral\Framework\DI\Construction\ServiceConstructionStrategy;
use Spiral\Framework\DI\Construction\Container;
use Spiral\Framework\DI\Definition\Schema;
use Spiral\Framework\DI\Definition\Service;

/**
 * Mock service construction Strategy
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockServiceConstructionStrategy extends AbstractServiceConstructionStrategy implements ServiceConstructionStrategy {

	public function buildService(Schema $schema,Container $container) {
		return $this->getService();
	}
}
?>
