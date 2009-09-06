<?php
namespace Spiral\Framework\Bootstrap;

require_once('Loader.php');

/**
 * Default loader interface
 *
 * Class used to load test classes, regarding the default Spiral Framework Package Architecture
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class TestsLoader extends DefaultLoader{
	/**
	 * Default path to find files
	 * 
	 * @var string
	 */
	protected static  $_defaultPath = 'Tests'; 
}
