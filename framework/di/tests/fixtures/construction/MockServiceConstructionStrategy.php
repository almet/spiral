<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractServiceConstructionStrategy;
use spiral\framework\di\construction\ServiceConstructionStrategy;
use spiral\framework\di\construction\Container;
use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\Service;

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
