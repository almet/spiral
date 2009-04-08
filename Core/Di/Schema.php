<?php
namespace Spiral\Core\Di;
use \Spiral\Core\Transfer\Collection\ICollection as ICollection;

/**
 * DI Schema
 *
 * Its the part of the Dependency Injector that represents the mapping between all classes, 
 * and their parameters
 *
 * Here is an example of use of the Schema class:
 * <code>
 * $schema = new Schema();
 * $schema->forObject('myObj','myClass')->inject('method')->with(array('parameters'));
 * </code>
 * 
 * @package     spiral
 * @subpackage  DI
 * @author      Alexis Métaireau 30 mars 2009
 */
class Schema implements ISchema{
    
    protected $_collection      = null;
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
     * Set the method to inject.
     *
     * @param   string  $methodName
     * @return  Schema
     */
    public function inject($methodName){
        $this->_processActiveObjects(
            function($object) use ($methodName){
                $object->inject($methodName);
            });   
        return $this;
    }
    
    /**
     * call 'inject' for a constructor.
     *
     * @return  Schema
     */
    public function construct(){
        $this->inject('__construct');
        return $this;
    }
    
    /**
     * Inject all the given parameters to the active Objects
     *
     * @return Schema
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
     * Add a method to call once the object instanciated.
     * just before returning it.
     *
     * @param   string  $method
     * @param   string  $class     
     * @return  Schema
     */
    public function addMethodCall($method, $key = null){
        $this->_processActiveObjects(
            function($object) use ($method, $key){
                $object->addMethodCall($method, $key);
            });   
        return $this;
    }
    
    /**
     * Add a method to call statically once the object instanciated.
     * just before returning it.
     *
     * @param   string  $class
     * @param   string  $method
     * @return  Schema
     */
    public function addStaticMethodCall($method, $class = null){
        $this->_processActiveObjects(
            function($object) use ($method, $class){
                $object->addStaticMethodCall($method, $class);
            });   
        return $this;
    }
    
    /**
	 * Getter
	 *
	 * Alias of getElement
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function __get($name){
	    return $this->getElement($name);
	}
	
	/**
	 * Isset
	 *
	 * Alias of hasElement
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function __isset($name){
	    return $this->hasElement($name);
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
	
	/**
	 * Return all elements
	 *
	 * @return	array
	 */
	public function getElements(){
	    return $this->_collection->getElements();
	}
	
	/**
	 * Return if an element exists
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function hasElement($name){
	    return $this->_collection->hasElement($name);
	}
}
?>
