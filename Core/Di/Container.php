<?php
namespace Spiral\Core\Di;
/**
 * The DI Container
 *
 * Its the part of the Dependency Injector 
 * that contain all classes
 *
 * Here is an example of use of the Di_Container class:
 * <code>
 * $container = new DiContaier();
 * $container->forObject('myObj','myClass')->inject('method')->with(array('parameters'));
 * </code>
 * 
 * @package     spiral
 * @subpackage  DI
 * @author      Alexis Métaireau 30 mars 2009
 */
class Container implements ContainerInterface{
    
    protected $_collection      = null;
    protected $_activeObjects   = null;
    
    /**
     * Construct the Di_Container and set up
     * the Collection used to store classes ojects
     *
     * @return void
     */
    public function __construct(){
        $this->_collection = new \Spiral\Core\Transfer\Collection\Base();
    }
    
    /**
     * Add a object to the container and 
     * set it as the active object
     *
     * @param   string  $key    the name of the object to register
     * @param   string  $object the object
     * @return  void
     */
    protected function _addObject($key, $object){
        $this->_collection->setElement($key, $object);
    }
    
    /**
     * Return all active objects
     *
     * @return  array
     */
    protected function _getActiveObjects(){
        // if we have a single object to return, build an array with it
        if (!is_array($this->_activeObjects) && !empty($this->_activeObjects)){
            $objects = array($this->_activeObjects);
        
        // otherwise, just return the array ..
        } elseif(is_array($this->_activeObjects)){
            $objects = $this->_activeObjects;
        
        // or nothin'
        } else {
            $objects = null;
        }
        
        return $objects;
    }
    
    /**
     * Check out if an Object with the given objectName
     * is already stored in the collection and return it. 
     * If not, create a new one, store it and return it
     *
     * @param   string  $objectName name of the wanted object
     * @param   string  $className  classname of the object
     * @return  Object
     */
    protected function _getDiObject($objectName, $className){
        if ($this->_collection->hasElement($objectName)){
            $object = $this->_collection->getElement($objectName);
        } else {
            $object = new Object($objectName, $className);
            $this->_addObject($objectName, $object);
        }
        // set it as active object
        $this->_activeObjects = $object;
        return $object;
    }
    
    /**
     * Loop on the _activeObject array and process it 
     * with an anonymous function
     *
     * @param   Closure     $anonymousFunction
     * @return  void
     */
    protected function _processActiveObjects($anonymousFunction){
        foreach($this->_getActiveObjects() as $Object){
            $anonymousFunction($Object);
        }
    }
    
    /**
     * Inject the constructor
     * @return  Di_Container
     */
    public function construct(){
        $this->inject('__construct');
        return $this;
    }
    
    /**
     * create and set the active object.
     * alias of _getObject that support 
     * fluid interface
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  Di_Container
     */
    public function forObject($key, $className){
        $this->_getDiObject($key, $className);
        return $this;
    }    
    
    /**
     * Set the method to inject.
     * Wrapper for Object to allow fluid interface
     *
     * @param   string  $methodName
     * @return  Di_Container
     */
    public function inject($methodName){
        $this->_processActiveObjects(
            function($diObject) use ($methodName){
                $diObject->inject($methodName);
            });   
        return $this;
    }
    
    /**
     * Inject all the given parameters to the active Objects
     *
     * @return Di_Container
     */
    public function with(){
        return $this->setArguments(func_get_args());
    }
    
    /**
     * Inject all the given parameters to the active Objects
     *
     * @param   array  $parameters
     * @return  Container
     */
    public function setArguments($parameters){
        foreach($parameters as $parameter){
            $this->addArgument($parameter);
        }
        return $this;
    }
    
    /**
     * Inject the selected method(s) with given parameter
     * Wrapper to the addParameter method of Object
     *
     * @param   string  $parameter
     * @return  Container     
     */
    public function addArgument($parameter){
        $this->_processActiveObjects(
            function($DiObject) use ($parameter){
                $DiObject->addArgument($parameter);
            });   
        return $this;
    }
    
    /**
     * Add a method to call once the object instanciated
     * just before returning it.
     *
     * Wrapper for the DiObject method
     *
     * @param   string  $method
     * @return  Di_Container
     */
    public function addMethodCall($method){
        $this->_processActiveObjects(
            function($DiObject) use ($method){
                $DiObject->addMethodCall($method);
            });   
        return $this;
    }
    
    /**
     * Resolve all dependencies and return the 
     * configured object
     *
     * @param   $key
     * @return  Object
     */
    public function get($key){
        
        // first, get the registred configuration object
        $diObject = $this->_collection->getElement($key);

        // get the constructor method
        $constructor = $diObject->getMethod('__construct');
        
        // get the classname
        $className = $diObject->getClassName();
        
        // build the object
        $object = new $className($constructor->buildListOfArgs());
        
        // call injected methods
        $diObject->callMethods($object);
        return $object;
    }    
}
?>
