<?php
namespace Spiral\Framework\Bootstrap;

require_once('Bootstrap.php');
require_once('DefaultLoader.php');
require_once('Constants.php');

/**
 * Bootstrap default implementation
 *
 * @author		Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
 class DefaultBootstrap implements Bootstrap
 {
 	/**
 	 * Bootstrap the application
 	 *
 	 * @return 	void
 	 */
 	public function run()
 	{
 		$this->setIncludePaths();
 		$this->registerAutoload();
 	}
 	
 	/**
 	 * Set the default incldude path for the Spiral project
 	 *
 	 * @return	void
 	 */
 	public function setIncludePaths()
 	{
 		set_include_path(BASE_PATH .'/'. PATH_SEPARATOR . get_include_path());
 	}
 	
 	/**
 	 * Register the autoload method
 	 *
 	 * @return	void
 	 */
 	public function registerAutoload()
 	{
 		spl_autoload_register(__NAMESPACE__.'\DefaultLoader::load');
 	}
 }
