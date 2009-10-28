<?php

namespace Spiral\Framework\Persistence\Fixtures;

/**
 * Represent a person
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class Person
{
	public $firstName = null;
	public $surName = null;
	
	public function __construct($firstName, $surName)
	{
		$this->firstName = $firstName;
		$this->surName = $surName;
	}
}
