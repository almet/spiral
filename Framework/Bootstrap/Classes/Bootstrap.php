<?php

namespace Spiral\Framework\Bootstrap;

/**
 * Bootstrap
 *
 * The bootstrap is an easy to use script to launch an application.
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
interface Bootstrap 
{
	/**
	 * Bootstrap the application
	 *
	 * @return 	void
	 */
	public function run();
}
