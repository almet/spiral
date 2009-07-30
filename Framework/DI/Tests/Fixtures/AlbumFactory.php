<?php

namespace Spiral\Framework\DI\Fixtures;

/**
 * Represent an album factory.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class AlbumFactory
{
	public function create($name, $year, $support)
	{
		return new Album($name, $year, $support);
	}
}
