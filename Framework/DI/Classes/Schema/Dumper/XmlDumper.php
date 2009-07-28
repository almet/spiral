<?php
namespace Spiral\Framework\DI\Schema\Dumper;

/**
 * This specific dumper convert a schema object into an xml string,
 * using the php lib SimpleXml
 *
 * @author  	Alexis Métaireau	23 may 2009
 * @copyright	Alexis Metaireau 	2009
 * @licence		GNU/GPL V3. Please see the COPYING FILE.
 */
class XmlDumper extends AbstractDumper
{
	/**
	 * convert the schema object into xml string
	 *
	 * @return 	string
	 */
    public function dump()
    {
        $xmlDoc = new SimpleXMLElement("<container></container>");
        
        // process all services
        foreach ($this->_schema as $service)
        {
            $xmlService = $xmlDoc->addChild('service');
            $xmlService->addAttribute('name', $service->getName());
            $xmlService->addAttribute('class', $service->getClassName());

            if ($service->isSingleton())
            {
                $xmlService->addAttribute('isSingleton', 'true');
            }
             
            // proces all methods
			foreach($service as $method)
			{
                $xmlMethod = $xmlService->addChild('method');
                if ($method->isStatic())
                {
                    $xmlMethod->addAttribute('class', $method->getClass());
                }
                $xmlMethod->addAttribute('name', $method->getName());

                // process all arguments
                foreach($method as $argument)
                {
                    if (get_class($argument) == '\Spiral\Framework\DI\Schema\ServiceArgument')
                    {
                        $isService = true;
                    } else {
                        $isService = false;
                    }
                    
                    $this->_addArgument($xmlMethod, $arg[0], $isService);
                }
            }
        }
        $xmlDoc->saveXML();
        return $xmlDoc->asXML();
    }

    protected function _addArgument($xmlNode, $arg, $isService = false)
    {
        $xmlArg = $xmlNode->addChild('argument');
        $xmlArg->addAttribute('type', gettype($arg));

        if (!is_array($arg))
        {
            $xmlArg->addAttribute('value', $arg);
        } else {
            foreach($arg as $value)
            {
                $this->_addArgument($xmlArg, $value);
            }
        }
        if($isService)
        {
            $xmlArg->addAttribute('service', 'true');
        }
    }
}
