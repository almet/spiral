<?php

namespace spiral\framework\di\fixtures;

use \spiral\framework\di\construction\Container;
use \spiral\framework\di\constructionAware;

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
