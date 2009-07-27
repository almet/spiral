<?php

/**
 * This specific builder convert an xml string into an schema object.
 *
 * @package     SpiralDi
 * @subpackage  SchemaBuilder  
 * @author  	Alexis Métaireau	23 may 2009
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Alexis Metaireau, Fredéric Sureau 2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class SpiralDi_SchemaBuilder_Xml extends SpiralDi_SchemaBuilder_File
{
	private $_xmlDoc = null;
	
	public function setFileName($fileName)
	{
		$this->_xmlDoc = simplexml_load_file($fileName);
	}
	
    public function buildSchema()
    {
        if(empty($this->_xmlDoc))
        {
        	throw new SpiralDi_SchemaBuilder_Xml_Exception_EmptySource();
        }
        
        $xmlDoc = $this->_xmlDoc;
        
        $schema = $this->getOriginalSchema();
        foreach($xmlDoc as $xmlService)
        {
            $scope = $this->_getValueOrDefault($xmlService, 'scope', 'singleton', 'string');
            $singleton = ($scope == "singleton");
            $extends = $this->_getValueOrDefault($xmlService, 'extends', null,  'string');
            $type = $this->_getValueOrDefault($xmlService, 'type', null,  'string');
        	
            $name =     (string)$xmlService['name'];
            $class =    $this->_getValueOrDefault($xmlService, 'class', null, 'string');
            $containerAware = $this->_getValueOrDefault($xmlService, 'containerAware', false, 'bool');
            
            if ($type == 'factory'){
                $scope = $this->_getValueOrDefault($xmlService, 'scope', 'prototype', 'string');
                $singleton = ($scope == "singleton");
                $service = new SpiralDi_Schema_Service_Factory($name, $class, $singleton);
            }
            elseif (!empty($extends))
            {
                $service = new SpiralDi_Schema_Service_Inherited($schema, $name, $extends, $class, $singleton);
            }
            else
            {
                $service = new SpiralDi_Schema_Service_Default($name, $class, $singleton);
            }
            
            $schema->addService($service);

            if ($containerAware)
            {
                $setDiContainer = new SpiralDi_Schema_Method_Default('setDiContainer');
                $container = new SpiralDi_Schema_Argument_Container();
                $setDiContainer->addArgument($container);
                $service->addMethod($setDiContainer);
            }

            foreach($xmlService as $xmlMethod)
            {
                $factoryMethod = null;
                if ('constructor' == $xmlMethod->getName())
                {
                    $name = '__construct';
                } else {
                    $name = (string)$xmlMethod['name'];
                }

                $class = $this->_getValueOrDefault($xmlMethod, 'class', null, 'string');
                
                $method = new SpiralDi_Schema_Method_Default($name,$class);
                $service->addMethod($method);

	            foreach($xmlMethod as $xmlArgument)
				{
                    $type = $this->_getValueOrDefault($xmlArgument, 'type', 'string');
                    $value = $this->_getValueOrDefault($xmlArgument, 'value', null, $type);
                    $ref = $this->_getValueOrDefault($xmlArgument, 'ref', null);

                    // TODO: check if type is in the php default types.
					if($type == 'service')
					{
						$argument = new SpiralDi_Schema_Argument_ServiceRef($value);
					}
                    elseif($type == 'container')
                    {
                        $argument = new SpiralDi_Schema_Argument_Container();
                    }
                    elseif(!empty($ref))
                    {
                        $factoryMethod = $this->_getValueOrDefault($xmlArgument, 'factoryMethod', null);
                        $argument = new SpiralDi_Schema_Argument_UseRef($ref, $factoryMethod, $value);
                    }
                    else
                    {
                        $argument =new SpiralDi_Schema_Argument_Default($value);
                    }
					
					$method->addArgument($argument);
				}
            }
        }

        return $schema;
    }

    /**
     * Return the value, if exist, or the default passed value
     * 
     * @param   SimpleXMLElement    $xmlNode
     * @param   string              $key
     * @param   mixed               $default
     * @param   string              $cast
     * @return  mixed
     */
    protected function _getValueOrDefault($xmlNode, $key, $default, $cast='string'){
        $value = $default;

        if(!empty($xmlNode[$key]))
        {
            if ($cast == 'service')
            {
                $cast = 'string';
            }
            $value = $xmlNode[$key];
            settype($value, $cast);
        }

        return $value;
    }
}
