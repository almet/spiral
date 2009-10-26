<?php
namespace Spiral\Framework\DI\Fixtures\Definition;

use Spiral\Framework\DI\Definition\Method;
use Spiral\Framework\DI\Definition\AbstractMethod;
use Spiral\Framework\DI\Construction;
use Spiral\Framework\DI\Fixtures\Construction\MockMethodConstructionStrategy;

class MockMethod extends AbstractMethod implements Method
{
	public function __construct(){
		$this->setConstructionStrategy(new MockMethodConstructionStrategy());
	}
    
	/**
	 * Returne the name of this method
	 * 
	 * @return string
	 */
	public function getName(){
		
	}

}
