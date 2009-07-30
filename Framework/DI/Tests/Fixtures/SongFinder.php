<?php

namespace Spiral\Framework\DI\Fixtures;

use \Spiral\Framework\DI\Container\Container;
use \Spiral\Framework\DI\ContainerAware;

/**
 * Represent an song finder.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class SongFinder extends ContainerAware
{
	public $container = null;
	
	public function setDIContainer(Container $container)
	{
		$this->container = $container;
	}
}
