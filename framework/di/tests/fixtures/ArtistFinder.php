<?php

namespace spiral\framework\di\fixtures;

use \spiral\framework\di\construction\Container;
use \spiral\framework\di\constructionAware;

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
