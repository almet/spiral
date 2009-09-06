<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\Bootstrap\Loader;
/**
 * Abstract Container implementation
 *
 * Define abstract container default methods and properties
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class Abstractcontainer
{
    /**
     * Shared services
     *
     * @var array
     */
    protected $_sharedServices = array();
    
    /**
     * the loader object
     *
     * @var	\Spiral\Framework\Bootstrap\Loader
     */
    protected $_loader  = null;
    
    /**
     * set the loader object given in parameter
     *
     * @param	\Spiral\framework\Bootstrap\Loader	$loader
     * @return	void
     */
    public function setLoader(Loader $loader){
    	if ($loader != null)
        {
            $this->_loader = $loader;
        }
    }
    
    /**
     * return the loader object
     * 
     * @return \Spiral\Framework\Bootstrap\Loader
     */
    public function getLoader(){
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
     * @return 	\Spiral\Framework\DI\Construction\DefaultContainer
     */
    public function addSharedService($serviceName, $service){
    	if (!is_object($service))
        {
            throw new Exception('Service '.$key.' must be an object');
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
    public function hasSharedService($serviceName){
    	return isset($this->_sharedServices[$serviceName]);
    }
    
    /**
     * Return, if exists, the asked shared service
     * 
     * @param 	string	$serviceName
     * @return 	mixed
     */
    public function getSharedService($serviceName){
    	if ($this->hasSharedService($serviceName)){
    		return $this->_sharedServices[$serviceName];
    	} else {
    		return false;
    	}
    }

    /**
     * Magic method get.
     *
     * Alias of getService()
     */
    public function __get($key)
    {
        return $this->getService($key);
    }

    /**
     * Magic method set.
     *
     * Alias of setService()
     * @param   string  $key
     * @param   object  $service
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
