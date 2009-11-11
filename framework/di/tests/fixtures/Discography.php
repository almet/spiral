<?php

namespace Spiral\Framework\DI\Fixtures;

/**
 * Represent an artist discography.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Discography
{
	public $albums = array();
	
	public function addAlbum(Album $album)
	{
		$this->albums[] = $album;
	}
}
