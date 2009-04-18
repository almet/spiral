<?php
namespace spiral\core\di;

/**
 * Interface for a Schema class
 *
 * @package     Spiral/Core/Di
 * @auhtor      Alexis Métaireau 1 Apr. 2009
 */
class Schema_Default implements Schema, Traversable, ArrayAccess, Countable{

    /**
     * Array containing all registred services
     * 
     * @var array
     */
    protected $_registredServices = array();
    
    /**
     * create and set the active object.
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  Service
     */
    public function setService($key, Service $service){
        $this->_registredServices[$key] = $service;
    }
	
	/**
	 * Return a registred service
	 *
	 * @param	string	$key
	 * @return	Service
     * @throws  UnknownService
	 */
	public function getService($key){
        if (!$this->hasService($key)){
            throw new Exception\UnknownService($key);
        }
        
        return $this->_registredServices[$key];
    }

    public function getRegistredServices(){
        return $this->_registredServices;
    }

    public function hasService($key){
        return array_key_exists($key, $this->_registredServices);
    }

    public function unsetService($key){
        unset($this->_registredServices[$key]);
    }

    public function offsetExists($offset){
        return $this->hasService($offset);
    }

    public function offsetGet($offset){
        return $this->getService($offset);
    }
    
    public function offsetSet($offset, $value){
        return $this->setService($offset, $value);
    }
    
    public function offsetUnset($offset){
        $this->unsetService($offset);
    }
}
?>
