<?php

namespace spiral\framework\di\fixtures;

use \spiral\framework\di\construction\Container;

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
