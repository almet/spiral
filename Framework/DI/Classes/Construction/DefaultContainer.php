<?php
namespace Spiral\Framework\DI\Construction;

use \Spiral\Framework\DI\Definition\Schema;
use \Spiral\Framework\Bootstrap\Loader;
use \Spiral\Framework\DI\Definition\FactoryService;
use \Spiral\Framework\DI\Definition\Argument;
use \Spiral\Framework\DI\Definition\Exception\UnknownMethodException;
use \Spiral\Framework\DI\ConstructionAware;

/**
 * Default Container implementation
 *
 * Use autoload of classes by default, if no Loader is specified at
 * construction time.
 *
 * See the interface for further information / documentation.
 *
 * @author  	Alexis Métaireau	16 apr. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */
class DefaultContainer extends AbstractContainer implements Container
{

    /**
     * The schema object
     *
     * @var	\Spiral\Framework\DI\Definition\Schema
     */
    protected $_schema;

    /**
     * set the schema object given in parameter
     *
     * @param	Schema     $schema
     * @param	Loader     $loader
     * @return	void
     */
    public function __construct(Schema $schema)
    {
        $this->_schema = $schema;
    }

    /**
     * Resolve all dependencies and return the  injected service object
     *
     * @param	string	$serviceName
     * @return	mixed
     * @throws	\Spiral\Framework\DI\Definition\Exception\UnknownServiceException
     */
    public function getService($serviceName){

        // get the registred service object
        return $this->_schema->getService($serviceName)->getconstructionStrategy()->buildService($this->_schema, $this);
    }
}
