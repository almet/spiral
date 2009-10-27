<?php

namespace spiral\framework\di\definition;

/**
 * Default argument, corresponding to native php types.
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultArgument extends AbstractArgument
{
    /**
     * The value of the argument
     * 
     * @var     mixed
     */
    protected $_value;
    
    /**
     * The construction context used to build the argument
     * 
     * @var 	ConstructionContext
     */
    protected $_context;
    
    /**
     * Constructor
     * 
     * @param   The value to be set
     * @return  void
     */
    public function __construct()
    {
    	// FIXME : Why not directly a parameter ?
        $this->_value = func_get_arg(0);
    }

    /**
     * Return the argument value
     * 
     * @return  mixed
     */
    public function getValue()
    {
        return $this->_value;
    }
}
