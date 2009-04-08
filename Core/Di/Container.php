<?php
namespace Spiral\Core\Di;
/**
 * the container is the class that store all
 * initialized objects, and can call the schema 
 * to resolve dependencies.
 *
 * Exemple of use
 * <code>
 * // prented here that we have already build our schema object as $schema
 * $container = new Container($schema);
 * // call the 'get' method, and, that's all folks !
 * $obj = $container->get('id');
 * // 'get' can be replaced by using the magix __get() method:
 * $obj = $container->id;
 * </code>
 */
class Container implements IContainer
{
    /**
     * The schema object
     *
     * @var ISchema
     */
    protected $_schema;
    
    /**
     * set the schema object given in parameter
     *
     * @param   Ischema $schema
     * @return  void
     */
    public function __construct(ISchema $schema){
        $this->_schema = $schema;
    }
    
    /**
     * Magic method get.
     *
     * Alias of get()
     */
    public function __get($name){
        return $this->get($key);
    }
    
    /**
     * Resolve all dependencies and return the 
     * configured object
     *
     * @param   String  $key
     * @return  mixed
     */
    public function get($key){
        
        // first, get the registred configuration object
        $diObject = $this->_schema->getElement($key);

        // get the constructor method
        $constructor = $diObject->getMethod('__construct');
        
        // get the classname
        $className = $diObject->getClassName();
        
        // build the object
        $object = new $className($constructor->buildListOfArgs());
        
        // call injected methods
        $diObject->callMethods($object);
        $diObject->callStaticsMethods($object);
        
        return $object;
    }
}
?>
