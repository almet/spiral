<?php
namespace Spiral\Framework\DI\Fixtures;

/**
 * Represent an album.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Album
{
	public $name = null;
	public $year = null;
	public $support = null;
	public $songs = array();
	
	public function __construct($name, $year, $support)
	{
		$this->name = $name;
		$this->year = $year;
		$this->support = $support;
	}
	
	public function addSong(array $songInformation)
	{
		$this->songs[] = $songInformation;
	}
	
	public function setSongs(array $songsInformation)
	{
		$this->songs = $songsInformation;
	}
}
