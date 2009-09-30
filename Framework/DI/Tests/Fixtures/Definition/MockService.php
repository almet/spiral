<?php
namespace Spiral\Framework\DI\Fixtures\Definition;

use Spiral\Framework\DI\Definition\Service;
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

class MockService implements Service {

	protected $_scope = 'uninitialisedScope';
	protected $_className = 'uninitialisedClassName';
	protected $_methods = array();
	protected $_name = '';
	protected $_constructionStrategy = null;    

	public function __construct(){
		$this->setConstructionStrategy(new MockServiceConstructionStrategy());
	}
	
	public function setScope($scope=null) {
		$this->_scope = $scope;
	}
	
	public function getClassName() {
		return $this->_className;
	}
	
	public function getMethod($name) {
		return $this->_methods[$name];
	}

	public function next() {
	}
	
	public function getScope() {
		return $this->_scope;
	}
	
	public function setConstructionStrategy(ServiceConstructionStrategy $strategy){
		$this->_constructionStrategy = $strategy;
		$strategy->setService($this);
	}
	
	public function current() {
	}
	public function getMethods() {
		return $this->_methods;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	public function hasMethod($method) {
		
	}

	public function rewind() {
	}
	public function getConstructionStrategy() {
		return $this->_constructionStrategy;
	}
	
	public function key() {
	}
	public function valid() {
	}
	public function addMethod(Method $method, $key = null){

	}
	public function getName() {
		return $this->_name;
	}
}
?>
