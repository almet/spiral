<?php
namespace spiral\framework\di\fixtures\definition;

use spiral\framework\di\definition\Argument;
use spiral\framework\di\definition\AbstractArgument;
use spiral\framework\di\fixtures\construction\MockArgumentConstructionStrategy;

class MockArgument extends AbstractArgument implements Argument
{
	protected $_value = null;
	
	public function __construct($value){
		$this->setValue($value);
		$this->setConstructionStrategy(new MockArgumentConstructionStrategy());
	}

	public function getValue() {
		return $this->_value;
	}

	public function setValue($value){
		$this->_value = $value;
	}
}
