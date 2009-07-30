<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents the active service
 *
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class EmptyValueArgument implements Argument
{
    /**
     * the getValue method return nothing
     * 
     * @return  null
     */
    public function getValue(){
        return null;
    }
}
?>
