<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\Container;
/**
 * Mock service used in tests
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockContainer implements Container {

	public function getService($key) {
	}
	public function __set($key,$service) {
	}
	public function addSharedService($serviceName,$service) {
	}
	public function getSharedService($serviceName) {
	}
	public function __isset($key) {
	}
	public function __get($key) {
	}
	public function hasSharedService($serviceName) {
	}
}
?>
