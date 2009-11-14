<?php

namespace spiral\framework\di\construction;

use \spiral\framework\bootstrap\Loader;
use \spiral\framework\di\construction\DefaultContainer;

/**
 * Abstract Container implementation
 *
 * Define abstract container default methods and properties
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
abstract class Abstractcontainer implements Container
{
    /**
     * Shared services
     *
     * @var array
     */
    protected $_sharedServices = array();
    
    /**
     * The loader object
     *
     * @var	Loader
     */
    protected $_loader  = null;
    
    /**
     * Set the loader object given in parameter
     *
     * @param	Loader	$loader
     * @return	void
     */
    public function setLoader(Loader $loader)
    {
    	if ($loader != null)
        {
            $this->_loader = $loader;
        }
    }
    
    /**
     * Return the loader object
     * 
     * @return Loader
     */
    public function getLoader()
    {
    	return $this->_loader;
    }
    
    /**
     * Add a builded service to the container, this service will be shared, and reused
     * 
     * Directly add object into the Container (bypassing the Schema)
     * Overwrite the Schema configuration
     *    
     * @param 	string	$serviceName
     * @param 	object	$service
     * @return 	DefaultContainer
     */
    public function addSharedService($serviceName, $service)
    {
    	if (!is_object($service))
        {
            throw new exception\InvalidSharedService('Service '.$serviceName.' must be an object, '.getType($service).' given');
        }
        
    	$this->_sharedServices[$serviceName] = $service;
    	return $this;
    }
    
    /**
     * Check if service has been shared
     * 
     * @param 	string	$serviceName
     * @return 	bool
     */
    public function hasSharedService($serviceName)
    {
    	return isset($this->_sharedServices[$serviceName]);
    }
    
    /**
     * Return, if exists, the asked shared service
     * 
     * @param 	string	$serviceName
     * @return 	mixed
     */
    public function getSharedService($serviceName)
    {
    	if ($this->hasSharedService($serviceName))
    	{
    		return $this->_sharedServices[$serviceName];
    	}
    	else
    	{
    		return false;
    	}
    }

    /**
     * Magic method get.
     *
     * Alias of getService()
     * 
     * @param	string	$key	Name of the service
     * @return	object
     */
    public function __get($key)
    {
        return $this->getService($key);
    }

    /**
     * Magic method set.
     *
     * Alias of setService()
     * 
     * @param   string  $key
     * @param   object  $service
     * @return	void
     */
    public function __set($key, $service)
    {
        $this->setService($key, $service);
    }

    /**
     * Magic method isset.
     * 
     * @param   string  $key
     * @return  boolean
     */
    public function __isset ($key)
    {
    	return ($this->hasSharedService($key) || $this->_schema->hasService($key));
    }
}