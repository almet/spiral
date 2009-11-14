<?php
namespace spiral\framework\di\fixtures\construction;

/**
 * Short description
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class MockLoader
{
	public $loadAttributes = array();
	
	public function load($className)
	{
		$this->loadAttributes = array($className);
	}
    
}
?>
