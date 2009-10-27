<?php

namespace spiral\framework\di\definition;

/**
 * Represents an alias to another service
 * 
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class AliasService extends DefaultService{

	/**
	 * Alias name for the service
	 * 
	 * @var string
	 */
	protected $_alias;
	
	/**
	 * Related service name
	 * 
	 * @var string
	 */
	protected $_serviceName;
	
	/**
     * The schema reference
     *
     * @var Schema
     */
    protected $_schema;

    /**
     * Build an alias service
     *
     * @param	string	$alias			Alias name
     * @param	string	$serviceName	Aliased service
     * @return	void
     */
    public function __construct($alias, $serviceName)
    {
        $this->_alias = $alias;
        $this->_serviceName = $serviceName;
    }
    
    /**
     * Return the service name
     * 
     * @return string
     */
    public function getServiceName()
    {
    	return $this->_serviceName;
    }
    
    /**
     * Return the name of the alias
     * 
     * @return string
     */
    public function getAlias()
    {
    	return $this->_alias;
    }
}
