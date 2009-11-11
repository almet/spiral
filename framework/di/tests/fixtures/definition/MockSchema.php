<?php
namespace spiral\framework\di\fixtures\definition;

use spiral\framework\di\definition\Schema;
use spiral\framework\di\definition\Service;
/**
 * Mock Schema
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockSchema implements Schema {
    
	public function getService($key) {
		$service = new MockService();
		$service->setName($key);
		return $service;
	}

	public function addService(Service $service, $key = null){

	}

	public function getServices() {
	}

	public function current() {
	}

	public function hasService($service) {
	}

	public function addServices(array $services) {
	}

}
?>
