<?php
namespace Spiral\Framework\DI\Fixtures\Definition;

use Spiral\Framework\DI\Definition\Argument;
use Spiral\Framework\DI\Definition\AbstractArgument;
use Spiral\Framework\DI\Fixtures\Construction\MockArgumentConstructionStrategy;

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
