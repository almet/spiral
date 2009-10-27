<?php

namespace spiral\framework\di\definition;

/**
 * Represents the active service
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class EmptyValueArgument extends DefaultArgument
{
	/**
     * Constructor
     * 
     * @param   The value to be set
     * @return  void
     */
    public function __construct()
    {
    }
    
    /**
     * The getValue method return nothing
     * 
     * @return  null
     */
    public function getValue()
    {
        return null;
    }
}
