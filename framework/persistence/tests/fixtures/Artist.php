<?php

namespace spiral\framework\persistence\fixtures;

/**
 * Represent an artist
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class Artist extends Person
{
	public $nickname = null;
	private $birthdate = null;
	public $discography = null;

	public function __construct($firstName, $surName)
	{
		parent::__construct($firstName, $surName);
	}
	
	public function setNickname($nickname)
	{
		$this->nickname = $nickname;
	}
	
	public function setBirthdate($birthdate)
	{
		$this->birthdate = $birthdate;
	}
	
	public function getBirthdate()
	{
		return $this->birthdate;
	}
	
	public function setDiscography(Discography $discography)
	{
		$this->discography = $discography;
	}
}
