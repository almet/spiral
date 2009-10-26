<?php

namespace spiral\framework\di\construction;

use \spiral\framework\bootstrap\Loader;
use \spiral\framework\di\definition\Schema;
use \spiral\framework\di\definition\exception\UnknownMethodException;

/**
 * Default Container implementation
 *
 * Use autoload of classes by default, if no Loader is specified at
 * construction time.
 *
 * See the interface for further information / documentation.
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultContainer extends AbstractContainer
{

    /**
     * The schema object
     *
     * @var	Schema
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
     * @throws	UnknownServiceException
     */
    public function getService($serviceName)
    {
        // get the registred service object
        return $this->_schema->getService($serviceName)->getConstructionStrategy()->buildService($this->_schema, $this);
    }
}
