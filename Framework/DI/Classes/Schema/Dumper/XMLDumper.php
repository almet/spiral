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
class XMLDumper extends AbstractDumper
{
	protected $_schemaVersion = "1.0";
	/**
	 * convert the schema object into xml string
	 *
	 * @return 	string
	 */
    public function dump()
    {
        $xmlDoc = new \SimpleXMLElement('<container xmlns="http://namespaces.spiral-project.org/framework/di/'.$this->_schemaVersion.'/schema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://localhost/Spiral/Framework/DI/Resources/schema.xsd"></container>');
        
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
				if ($method->getName() == "__construct")
				{
					$xmlMethod = $xmlService->addChild('constructor');
				}
				else 
				{
		            $xmlMethod = $xmlService->addChild('method');
		            if ($method->isStatic())
		            {
		                $xmlMethod->addAttribute('class', $method->getClass());
		            }
		            $xmlMethod->addAttribute('name', $method->getName());
	            }

                // process all arguments
                foreach($method as $argument)
                {
                    if ($argument instanceof ServiceArgument)
                    {
                        $isService = true;
                    } else {
                        $isService = false;
                    }
                    
                    $this->_addArgument($xmlMethod, $argument->getValue(), $isService);
                }
            }
        }
        $xmlDoc->saveXML();
        return $xmlDoc->asXML();
    }

    protected function _addArgument($xmlNode, $argumentValue, $isService = false)
    {
        $xmlArg = $xmlNode->addChild('argument');
        $xmlArg->addAttribute('type', gettype($argumentValue));

        if (!is_array($argumentValue))
        {
            $xmlArg->addAttribute('value', $argumentValue);
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
