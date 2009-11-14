<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractServiceConstructionStrategy;
use spiral\framework\di\definition\Schema;
use spiral\framework\di\construction\Container;

/**
 * Mock for abstract Service construction strategy
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class MockAbstractServiceConstructionStrategy extends AbstractServiceConstructionStrategy
{
    public function buildService(Schema $schema, Container $container)
	{
		
	}
}
?>
