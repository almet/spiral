<?php

namespace spiral\framework\persistence\fixtures;

/**
 * Represent an artist discography
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class Discography
{
	public $albums = array();
	
	public function addAlbum(Album $album)
	{
		$this->albums[] = $album;
	}
}
