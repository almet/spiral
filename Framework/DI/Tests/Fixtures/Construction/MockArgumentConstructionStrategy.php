<?php
namespace Spiral\Framework\DI\Fixtures\Construction;

use Spiral\Framework\DI\Construction\AbstractArgumentConstructionStrategy;
use Spiral\Framework\DI\Construction\ArgumentConstructionStrategy;
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

class MockArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy implements ArgumentConstructionStrategy {

	public function buildArgument(Container $container,$currentService) {
		return $this->getArgument();
	}
}
?>
