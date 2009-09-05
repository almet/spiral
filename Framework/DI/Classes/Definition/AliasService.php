<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents an alias to another service
 * 
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 * @author  AME 18 juin 2009
 */
class AliasService extends AbstractService implements Service{

	/**
	 * alias name for the service
	 * 
	 * @var string
	 */
	protected $_alias;
	
	/**
	 * related service name
	 * 
	 * @var string
	 */
	protected $_serviceName;
	
	/**
     * The schema reference
     *
     * @var     \Spiral\Framework\DI\Definition\Schema
     */
    protected $_schema;

    /**
     * Build an alias service
     *
     * @param	\Spiral\Framework\DI\Definition\Schema	$schema
     */
    public function __construct(Schema $schema, $alias, $serviceName){
    	$this->_schema = $schema;
        $this->_alias = $alias;
        $this->_serviceName = $serviceName;
    }
    
    /**
     * return the service name
     * 
     * @return string
     */
    public function getServiceName(){
    	return $this->_serviceName;
    }
    
    /**
     * return the name of the alias
     * 
     * @return string
     */
    public function getAlias(){
    	return $this->_alias;
    }
}
?>
