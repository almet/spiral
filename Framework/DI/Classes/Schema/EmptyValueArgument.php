<?php
/**
 * Represents the active service
 *
 * @package     SpiralDi
 * @subpackage  Schema  
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class SpiralDi_Schema_Argument_EmptyValue implements SpiralDi_Schema_Argument
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
