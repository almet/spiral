<?php
namespace Spiral\Core\Di;

/**
 * DI Schema
 *
 * This part of the Dependency callor represents the mapping between all classes, 
 * and their parameters
 *
 * Here is an example of how to use this class:
 * <code>
 * $schema = new Schema();
 * $schema->forObject('myObj','myClass')->call('method')->with(array('parameters'));
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
    const   SELF = 'SPIRAL_DI_SELF_OBJECT';
    
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
    protected $_activeObjects   = null;
    
    /**
     * Set up the Collection used to store 
     * classes ojects
     *
     * @return void
     */
    public function __construct(){
        $this->_collection = new \Spiral\Core\Transfer\Collection\Collection();
    }
    
    /**
     * Add a object to the schema and set it as the active object
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
     * If not, create a new one, store and return it
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
        foreach($this->_getActiveObjects() as $object){
            $anonymousFunction($object);
        }
    }
    
    
    /**
     * create and set the active object.
     * alias of _getObject that support 
     * fluid interface
     * 
     * @param   string  $key
     * @param   string  $className
     * @return  Schema
     */
    public function forObject($key, $className){
        $this->_getDiObject($key, $className);
        return $this;
    }    
    
    /**
     * Set the method to call.
     *
     * @param   string  $methodName
     * @return  Schema
     */
    public function call($methodName){
        $this->_processActiveObjects(
            function($object) use ($methodName){
                $object->call($methodName);
            });   
        return $this;
    }
    
    public function callStatic($className, $methodName){
        $this->_processActiveObjects(
            function($object) use ($methodName, $className){
                $object->call($methodName, $className);
            });   
        return $this;
    }
    
    /**
     * call 'call' for a constructor.
     *
     * @return  Schema
     */
    public function construct(){
        $this->call('__construct');
        return $this;
    }
    
    /**
     * call all the given parameters to the active Objects
     *
     * @return Schema
     */
    public function with(){
        return $this->setArguments(func_get_args());
    }
    
    /**
     * call all the given parameters to the active Objects
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
     * call the selected method(s) with given parameter
     *
     * @param   string  $parameter
     * @return  Container     
     */
    public function addArgument($parameter){
        $this->_processActiveObjects(
            function($object) use ($parameter){
                $object->addArgument($parameter);
            });   
        return $this;
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
