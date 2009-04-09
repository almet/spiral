<?php
namespace Spiral\Core\Di;
use \Spiral\Core\Transfer\Collection\Collection as Collection;
/**
 * DI Schema
 *
 * This part of the Dependency callor represents the mapping between all classes, 
 * and their parameters
 *
 * Here is an example of how to use this class:
 * <code>
 * $schema = new Schema();
 * $schema->registerService('myObj','myClass')->call('method')->with(array('parameters'));
 * </code>
 * 
 * @package     Spiral\Core\Di
 * @author      Alexis Métaireau 30 mar. 2009
 */
class Schema implements ISchema{

    /**
     * Constants that's represents the current resolved object.
     * Used in with() method.
     */
    const   ACTIVE_SERVICE = 'SPIRAL_DI_ACTIVE_SERVICE';
    
    /**
     * Store the collection of all registered classes
     *
     * @var ICollection
     */
    protected $_collection      = null;
    
    /**
     * Array of active objects
     *
     * @var Array
     */
    protected $_activeServices   = null;
    
    /**
     * Set up the Collection used to store 
     * classes ojects
     *
     * @return void
     */
    public function __construct(){
        $this->_collection = new Collection();
    }
    
    /**
     * Add a service to the schema and set it as the active one
     *
     * @param   string  $key        the name of the service to register
     * @param   string  $service    the service itself
     * @return  void
     */
    protected function _addService($key, $service){
        $this->_collection->setElement($key, $service);
    }
    
    /**
     * Return all active objects
     *
     * @return  array
     */
    protected function _getActiveServices(){
        // if we have a single object to return, build an array with it
        if (!is_array($this->_activeServices) && !empty($this->_activeServices)){
            $services = array($this->_activeServices);
        
        // otherwise, just return the array ..
        } elseif(is_array($this->_activeServices)){
            $services = $this->_activeServices;
        
        // or nothin'
        } else {
            $services = null;
        }
        
        return $services;
    }
    
    /**
     * Check out if a service with the given name
     * is already stored in the collection and return it. 
     * If not, create a new one, store and return it
     *
     * @param   string  $key        name of the wanted service
     * @param   string  $className  classname of the service
     * @return  Object
     */
    protected function _getService($key, $className){
        if ($this->_collection->hasElement($key)){
            $service = $this->_collection->getElement($key);
        } else {
            $service = new Service($key, $className);
            $this->_addService($key, $service);
        }
        // set it as active object
        $this->_activeServices = $service;
        return $service;
    }
    
    /**
     * Loop on the array of active services and process it
     * with an anonymous function
     *
     * @param   Closure     $anonymousFunction
     * @return  void
     */
    protected function _processActiveServices($anonymousFunction){
        foreach($this->_getActiveServices() as $service){
            $anonymousFunction($service);
        }
    }
    
    
    /**
     * create and set the active object.
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  Schema
     */
    public function registerService($key, $className){
        $this->_getService($key, $className);
        return $this;
    }    
    
    /**
     * Set the method to call.
     *
     * @param   string  $methodName
     * @return  Schema
     */
    public function onCall($methodName){
        $this->_processActiveServices(
            function($service) use ($methodName){
                $service->call($methodName);
            });   
        return $this;
    }
    
    public function onStaticCall($className, $methodName){
        $this->_processActiveServices(
            function($service) use ($methodName, $className){
                $service->call($methodName, $className);
            });   
        return $this;
    }
    
    /**
     * call 'call' for a constructor.
     *
     * @return  Schema
     */
    public function onConstruct(){
        $this->onCall('__construct');
        return $this;
    }
    
    /**
     * inject all given params to active objects
     *
     * @param   mixed
     * @return  Schema
     */
    public function injectWith(){
        return $this->setArguments(func_get_args());
    }
    
    /**
     * call all the given parameters to the active Objects
     *
     * @param   array   $parameters
     * @param   Bool    $asService  Specify if the given parameters has to be used as services
     * @return  Container
     */
    public function setArguments($parameters, $asService = false){
        foreach($parameters as $parameter){
            $this->addArgument($parameter, $asService);
        }
        return $this;
    }
    
    
    
    /**
     * call the selected method(s) with given parameter
     *
     * @param   string  $parameter
     * @return  Container     
     */
    public function addArgument($parameter, $asService = false){
        $this->_processActiveServices(
            function($service) use ($parameter, $asService){
                $service->addArgument($parameter, $asService);
            });   
        return $this;
    }
    
    /**
     * inject all given params to active objects 
     *
     * @param   mixed
     * @return  Schema
     */
    public function injectWithServices(){
        return $this->setArguments(func_get_args(), true);
    }
    
    /**
     * Alias for setArgument, for services
     * 
     * @param   array   $parameters
     * @return  Schema
     */
    public function setArgumentsAsServices($parameters){
        return $this->setArguments($parameters, true);
    }
    
    /**
     * Alias for addArgument, for a service
     * 
     * @param   string   $parameter
     * @return  Schema
     */
    public function addArgumentAsService($parameter){
        return $this->addArgument($parameters, true);
    }
	
	/**
	 * Return an element value 
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function getElement($name){
	    return $this->_collection->getElement($name);
	}
}
?>
