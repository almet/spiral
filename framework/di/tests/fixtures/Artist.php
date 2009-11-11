<?php

namespace spiral\framework\di\fixtures;

/**
 * Represent an artist.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class Artist
{
	public $firstName = null;
	public $surName = null;
	public $nickname = null;
	public $birthdate = null;
	public $discography = null;

	public function __construct($firstName, $surName)
	{
		$this->firstName = $firstName;
		$this->surName = $surName;
	}
	
	public function setNickname($nickname)
	{
		$this->nickname = $nickname;
	}
	
	public function setBirthdate($birthdate)
	{
		$this->birthdate = $birthdate;
	}
	
	public function setDiscography(Discography $discography)
	{
		$this->discography = $discography;
	}
	
	public function setSongFinder(SongFinder $songFinder)
	{
		$this->songFinder = $songFinder;
	}
}
