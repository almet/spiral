<?php
namespace spiral\framework\di\fixtures\definition;

use spiral\framework\di\definition\DefaultMethod;
use spiral\framework\di\fixtures\construction\MockMethodConstructionStrategy;

class MockMethod extends DefaultMethod
{
	protected $_name = null;

	public function __construct($name = null)
	{
		if($name !== null)
		{
			$this->_name = $name;
		}
		$this->setConstructionStrategy(new MockMethodConstructionStrategy());
	}

	/**
	 * Returne the name of this method
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}

}
