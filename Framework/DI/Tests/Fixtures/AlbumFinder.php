<?php

namespace Spiral\Framework\DI\Fixtures;

use \Spiral\Framework\DI\Container\Container;

/**
 * Represent an album finder.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class AlbumFinder
{
	public $container = null;
	
	public function __construct(Container $container)
	{
		$this->container = $container;
	}
}
