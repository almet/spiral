<?php
namespace \Spiral\Framework\DI\Schema;

/**
 * Default argument, corresponding to a factory.
 *
 * This class represents an agrument to be passed to the Scheme_Method class
 *
 * @author  	Alexis Métaireau	16 jun. 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class UseRefargument extends DefaultArgument{
    protected
        $_factoryMethod,
        $_ref;

    /**
     *
     * @param   string  $key
     * @param   string  $factoryMethod  the factory method to call
     */
    public function __construct($ref, $factoryMethod=null, $value=null)
    {
        $this->_ref = $ref;
        $this->_factoryMethod = $factoryMethod;
        $this->_value = $value;
    }

    /**
     * Return the factory method to call in order to resolve the wanted value
     * @return string
     */
    public function getFactoryMethod()
    {
        return $this->_factoryMethod;
    }

    /**
     * Return the service reference key
     * 
     * @return  string
     */
    public function getRef()
    {
        return $this->_ref;
    }
}
?>
