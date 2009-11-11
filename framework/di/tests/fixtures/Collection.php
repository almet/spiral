<?php

namespace Spiral\Framework\DI\Fixtures;

/**
 * Represent a collection of elements.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Collection
{
	public $elements = array();

	public function setElement($key, $value)
	{
		$this->elements[$key] = $value;
	}
	
	public function getElement($key)
	{
		return $this->elements[$key];
	}
	
	public function __set($key, $value)
	{
		$this->setElement($key, $value);
	}
	
	public function __get($key)
	{
		return $this->getElement($key);
	}
}
