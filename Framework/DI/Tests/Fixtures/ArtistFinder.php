<?php

namespace Spiral\Framework\DI\Fixtures;

use \Spiral\Framework\DI\Construction\Container;
use \Spiral\Framework\DI\ConstructionAware;

/**
 * Represent an artist finder.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class ArtistFinder extends ContainerAware
{
	public $container = null;
	
	public function setDIContainer(Container $container)
	{
		$this->container = $container;
	}
}
