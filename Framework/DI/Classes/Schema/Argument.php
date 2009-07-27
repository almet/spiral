<?php

/**
 * Interface for a Argument class
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
interface SpiralDi_Schema_Argument {

    /**
     * return the argument value
     *
     * @return  mixed
     */
    public function getValue();
}
?>
