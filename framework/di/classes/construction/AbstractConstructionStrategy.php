<?php

namespace spiral\framework\di\construction;

use \spiral\framework\bootstrap\Loader;

/**
 * Abstract argument
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class AbstractConstructionStrategy
{	
	/**
	 * Loader
	 * 
	 * @var Loader
	 */
	protected $_loader;
	
	/**
     * Call the loader if defined
     *
     * @return	void
     */
    public function load($className)
    {
        if ($this->_loader != null)
        {
            $this->_loader->load($className);
        }
    }
    
    /**
     * Set the loader class
     * 
     * @param 	Loader	$loader		Loader that should be used to load class
     * @return	void
     */
    public function setLoader($loader)
    {
    	$this->_loader = $loader;
    }
	
}