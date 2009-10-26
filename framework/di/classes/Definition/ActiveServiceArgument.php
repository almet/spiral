<?php
namespace Spiral\Framework\DI\Definition;

/**
 * Represents the active service
 *
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class ActiveServiceArgument extends EmptyValueArgument
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
