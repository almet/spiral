<?php

namespace Spiral\Framework\Persistence\Fixtures;

/**
 * Represent an artist
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
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
	
	public function setDiscography(Discography $discography)
	{
		$this->discography = $discography;
	}
}
