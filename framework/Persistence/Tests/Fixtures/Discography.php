<?php

namespace Spiral\Framework\Persistence\Fixtures;

/**
 * Represent an artist discography
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
class Discography
{
	public $albums = array();
	
	public function addAlbum(Album $album)
	{
		$this->albums[] = $album;
	}
}
