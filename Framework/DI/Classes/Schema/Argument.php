<?php
namespace Spiral\Framework\DI\Schema;

/**
 * Interface for a Argument class
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
interface Argument {

    /**
     * return the argument value
     *
     * @return  mixed
     */
    public function getValue();
}
?>
