<?php
namespace Spiral\Framework\DI\Fixtures\Definition;

use Spiral\Framework\DI\Definition\Method;
use Spiral\Framework\DI\Definition\AbstractMethod;
use Spiral\Framework\DI\Construction;
use Spiral\Framework\DI\Fixtures\Construction\MockMethodConstructionStrategy;

class MockMethod extends AbstractMethod implements Method
{
	protected $_name = null;

	public function __construct($name = null){
		if($name !== null){
			$this->_name = $name;
		}
		$this->setConstructionStrategy(new MockMethodConstructionStrategy());
	}

	/**
	 * Returne the name of this method
	 *
	 * @return string
	 */
	public function getName(){
		return $this->_name;
	}

}
