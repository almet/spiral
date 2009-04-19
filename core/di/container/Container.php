<?php
namespace spiral\core\di\container;
use \spiral\core\di\schema\Schema,
	\spiral\core\loader\Loader;
/**
 * Interface for the Di Container
 *
 * The aim of a Di Container is to build an object from classes contained in a 
 * schema object, and to inject it's methods and properties, according to the 
 * schema.
 *
 * To load the good class before instantiate it, the container can use a loader
 *
 * Here is a way to use it:
 * 
 * <code>
 * $container = new Container_Impl($schema);
 * $serv = $container->getService('serviceName');
 * // or using the magic __get method:
 * $serv = $container->serviceName;
 * </code>
 * 
 * @author  	Alexis Métaireau    16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE. 
 */
interface Container
{
 /**
     * set the schema object given in parameter
     *
     * @param   Schema 	$schema
     * @param	Loader	$loader
     * @return  void
     */
    public function __construct(Schema $schema, Loader $loader = null);
    
    /**
     * Call all dynamic registered methods
     *
     * @param   array   $methods    methods to call
     * @param   mixed   $object object to act on
     * @return  void
     */
    public function injectMethods($methods, $object);
    
    /**
     * Resolve all dependencies and return the 
     * injected service object
     *
     * @param   string  $key
     * @return  mixed
     */
    public function getService($key);

	/**
     * Magic method get.
     *
     * Alias of getService()
     */
    public function __get($key);
}
?>
