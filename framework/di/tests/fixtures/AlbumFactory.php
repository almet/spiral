<?php

namespace spiral\framework\di\fixtures;

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
