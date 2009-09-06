<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents an Inherithed Schema Service
 *
 * @author  	AME 17 juin 2009 
 * @copyright	Alexis Metaireau 	2009
 * @license		http://opensource.org/licenses/gpl-3.0.html GNU Public License V3
 */
class InheritedService extends DefaultService
{

    /**
     * The inherited service name
     * 
     * @var     string
     */
    protected $_inherit;

    /**
     * Build an inherithed service
     *
     * @param   string  $service    the service name
     * @param   string  $inherit    the service name that is inherited
     * @param   string  $className  the classname, if different than the inherithed one
     * @param   string	$scope
     */
    public function __construct($service, $inherit, $className='', $scope=null)
    {
        $this->_inherit = $inherit;
        parent::__construct($service, $className, $scope);
	}

    /**
     * Return the name of the inherited service
     * 
     * @return  string
     */
    public function getInheritedService(){
        return $this->_inherit;
    }
}
?>
