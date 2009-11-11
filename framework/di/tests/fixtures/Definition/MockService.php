<?php
namespace Spiral\Framework\DI\Fixtures\Definition;

use Spiral\Framework\DI\Definition\Service;
use Spiral\Framework\DI\Definition\AbstractService;
use Spiral\Framework\DI\Definition\Method;
use Spiral\Framework\DI\Construction\ServiceConstructionStrategy;
use Spiral\Framework\DI\Fixtures\Construction\MockServiceConstructionStrategy;
/**
 * Mock service used in tests
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockService extends AbstractService implements Service {

	protected $_className = 'uninitialisedClassName';
	protected $_methods = array();
	protected $_name = '';

	public function __construct(){
		$this->setConstructionStrategy(new MockServiceConstructionStrategy());
	}
	
	public function getClassName() {
		return $this->_className;
	}
	
	public function getMethod($name) {
		return $this->_methods[$name];
	}

	public function getMethods() {
		return $this->_methods;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	public function hasMethod($method) {
		
	}
	
	public function addMethod(Method $method, $key = null){

	}
	public function getName() {
		return $this->_name;
	}
}
?>
