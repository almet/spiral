<?php
/**
 * Represents an Inherithed Schema Service
 * 
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  AME 17 juin 2009
 */
class SpiralDi_Schema_Service_Inherited extends SpiralDi_Schema_Service_Default
{

    /**
     * The inherited service name
     * 
     * @var     SpiralDi_Schema_Service
     */
    protected $_inherit;

    /**
     * The schema reference
     *
     * @var     SpiralDi_Schema
     */
    protected $_schema;

    /**
     * Build an inherithed service
     *
     * @param   SpiralDi_Schema     $schema
     * @param   string              $service    the service name
     * @param   string              $inherit    the service that is inherited
     * @param   string              $className  the classname, if different than the inherithed one
     * @param   bool                $isSingleton
     */
    public function __construct($schema, $service, $inherit, $className='', $isSingleton=null)
    {
        $this->_schema = $schema;
		$this->_serviceName = $service;
        $this->_inherit = $inherit;
        $this->_className  = $className;
        $this->_isSingleton  = $isSingleton;
	}

    /**
     * Return the name of the inherited service
     * 
     * @return  SpiralDi_Schema_Service
     */
    public function getInheritedService(){
        return $this->_schema->getService($this->_inherit);
    }

    /**
	 * Return the classname
	 *
	 * @return	string
	 */
	public function getClassName(){
        $className = $this->_className;
        if (empty($className)){
            $className = $this->getInheritedService()->getClassName();
        }
        return $className;
    }

    /**
     * Tell if this service is a singleton or not
     *
     * @return  void
     */
    public function isSingleton(){
        $singleton = $this->_isSingleton;
        if (empty($singleton)){
            $singleton = $this->getInheritedService()->isSingleton();
        }
        return $singleton;
    }

    /**
	 * Return the method corresponding to the name
     * 
     * If the child service has implemented the method, return this one,
     * if not, search in the parent service
	 *
	 * @param	string	  $name
	 * @return	Method
	 * @throws	UnknownMethod
	 */
	public function getMethod($name){
        if (parent::hasMethod($name)){
            return parent::getMethod($name);
        }
        return $this->getInheritedService()->getMethod($name);
    }

	/**
	 * return the internal array of methods
	 *
	 * @return Array
	 */
	public function getMethods(){
        $methods = array();
        foreach($this->getInheritedService()->getMethods() as $inheritedMethod){
            $methods[$inheritedMethod->getName()] = $this->getMethod($inheritedMethod->getName());
        }
        foreach(parent::getMethods() as $childMethod){
            if (!isset($methods[$childMethod->getName()])){
                $methods[$childMethod->getName()] = $childMethod;
            }
        }
        return $methods;
    }
}
?>
