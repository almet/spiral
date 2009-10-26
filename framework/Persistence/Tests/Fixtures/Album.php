<?php

namespace Spiral\Framework\Persistence\Fixtures;

/**
 * Represent an album
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
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
