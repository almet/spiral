<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents an alias to another service
 * 
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 * @author  AME 18 juin 2009
 */
class AliasService extends DefaultService{

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
     * @param	string	$alias			alias name
     * @param	string	$serviceName	aliased service
     */
    public function __construct($alias, $serviceName){
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
