<?php

namespace spiral\framework\persistence\fixtures;

/**
 * Represent an album
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
