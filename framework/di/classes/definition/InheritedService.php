<?php

namespace spiral\framework\di\definition;

/**
 * Represents an Inherithed Schema Service
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
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
     * @return	void
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
