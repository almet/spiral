<?php
namespace \Spiral\Framework\DI\Schema\Builder;
use \Spiral\framework\DI\Schema\Builder\Exception\EmptyXmlSourceException;
use \Spiral\framework\DI\Schema\DefaultService;
use \Spiral\framework\DI\Schema\FactoryService;
use \Spiral\framework\DI\Schema\InheritedService;
use \Spiral\framework\DI\Schema\DefaultMethod;
use \Spiral\framework\DI\Schema\ServiceRefArgument;
use \Spiral\framework\DI\Schema\UseRefArgument;
use \Spiral\framework\DI\Schema\ActiveServiceArgument;
use \Spiral\framework\DI\Schema\ContainerArgument;
use \Spiral\framework\DI\Schema\DefaultArgument;
use \Spiral\framework\DI\Schema\EmptyValueArgument;

/**
 * This specific builder convert an xml string into an schema object.
 *
 * @author  	Alexis Métaireau	23 may 2009
 * @author  	Frédéric Sureau		10 jun. 2009
 * @copyright	Alexis Metaireau, Fredéric Sureau 2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class XmlBuilder extends FileBuilder
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
        	throw new EmptyXmlSourceException();
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
                $service = new FactoryService($name, $class, $singleton);
            }
            elseif (!empty($extends))
            {
                $service = new InheritedService($schema, $name, $extends, $class, $singleton);
            }
            else
            {
                $service = new DefaultService($name, $class, $singleton);
            }
            
            $schema->addService($service);

            if ($containerAware)
            {
                $setDiContainer = new DefaultMethod('setDiContainer');
                $container = new ContainerArgument();
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
                
                $method = new DefaultMethod($name,$class);
                $service->addMethod($method);

	            foreach($xmlMethod as $xmlArgument)
				{
                    $type = $this->_getValueOrDefault($xmlArgument, 'type', 'string');
                    $value = $this->_getValueOrDefault($xmlArgument, 'value', null, $type);
                    $ref = $this->_getValueOrDefault($xmlArgument, 'ref', null);

                    // TODO: check if type is in the php default types.
					if($type == 'service')
					{
						$argument = new ServiceRefArgument($value);
					}
                    elseif($type == 'container')
                    {
                        $argument = new ContainerArgument();
                    }
                    elseif(!empty($ref))
                    {
                        $factoryMethod = $this->_getValueOrDefault($xmlArgument, 'factoryMethod', null);
                        $argument = new UseRefArgument($ref, $factoryMethod, $value);
                    }
                    else
                    {
                        $argument = new DefaultArgument($value);
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
