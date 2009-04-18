<?php
namespace spiral\core\di;

/**
 * Interface for a Schema class
 *
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
interface Schema{
    /**
     * Constants that's represents the current resolved object.
     */
    const   ACTIVE_SERVICE = 'SPIRAL_DI_ACTIVE_SERVICE';

    /**
     * create and set the active object.
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  Service
     */
    public function registerService($key, Service $service);
	
	/**
	 * Return a registred service
	 *
	 * @param	string	$key
	 * @return	mixed
	 */
	public function getService($key);

    /**
     * Return the schema
     *
     * @return Schema
     */
    public function getSchema();

    /**
     * Return an array of all registred services
     *
     * @return  Array
     */
    public function getRegistredServices();
}
?>
