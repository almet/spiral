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
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
 class DefaultBootstrap implements Bootstrap
 { 	
 	
 	/**
 	 * Bootstrap the application
 	 *
 	 * @return 	void
 	 */
 	public function run(){
 		$this->init();
 	}
 	
 	public function init(){
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
	 * Proxy to add default path for Default loader
	 * 
	 * @param	string $path
	 * @return	void
	 */
	public function addDefaultPath($path){
		return DefaultLoader::addDefaultPath($path);
	}
 	
 	/**
 	 * Register the autoload method
 	 *
 	 * @return	void
 	 */
 	public function registerAutoload($autoloadCallback = null)
 	{
 		if ($autoloadCallback === null){
	 		$autoloadCallback = __NAMESPACE__.'\DefaultLoader';
 		}
 		DefaultLoader::load($autoloadCallback);
 		spl_autoload_register($autoloadCallback.'::load');
 	}
 }
