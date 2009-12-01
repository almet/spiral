<?php

namespace spiral\framework\persistence\fixtures;

/**
 * Represent a person
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
