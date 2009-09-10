<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition;

/**
 * Abstract argument
 *
 * @author  	Alexis Métaireau	30 jul. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
abstract class AbstractConstructionStrategy
{	
	/**
	 * loader
	 * 
	 * @var 
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
     * @param 	$loader
     * @return	void
     */
    public function setLoader($loader)
    {
    	$this->_loader = $loader;
    }
	
}