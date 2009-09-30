<?php
namespace Spiral\Framework\DI\Fixtures;

/**
 * Represent a generalist store. 
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Store
{
	public $constructionArgument = 23;
	public $name = 'Default name';
	
	public function __construct($constructionArgument=null)
	{
		$this->constructionArgument = $constructionArgument;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
}
