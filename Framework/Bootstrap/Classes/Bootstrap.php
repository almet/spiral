<?php
namespace Spiral\Framework\Bootstrap;

/**
 * Bootstrap Interface for Spiral Framework
 *
 * The aim of the Bootstrap is to boot provide a simple interface for booting 
 * all classes/packages used in Spiral.
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
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
