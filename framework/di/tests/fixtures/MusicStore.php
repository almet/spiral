<?php

namespace spiral\framework\di\fixtures;

/**
 * Represent a music store.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class MusicStore extends Store
{
	public $artists = array();
	public $albumFinder = null;
	public $artistFinder = null;
	public $songFinder = null;

	public function addArtist(Artist $artist)
	{
		$this->artists[] = $artist;
	}
	
	public function setAlbumFinder(AlbumFinder $albumFinder)
	{
		$this->albumFinder = $albumFinder;
	}
	
	public function setArtistFinder(ArtistFinder $artistFinder)
	{
		$this->artistFinder = $artistFinder;
	}
	
	public function setSongFinder(SongFinder $songFinder)
	{
		$this->songFinder = $songFinder;
	}
}
