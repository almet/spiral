<?php

namespace Spiral\Framework\DI\Fixtures;

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
