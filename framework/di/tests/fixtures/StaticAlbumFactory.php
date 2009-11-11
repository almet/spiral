<?php

namespace spiral\framework\di\fixtures;

/**
 * Represent a static album factory.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class StaticAlbumFactory
{
	public static function create($name, $year, $support)
	{
		return new Album($name, $year, $support);
	}
}
