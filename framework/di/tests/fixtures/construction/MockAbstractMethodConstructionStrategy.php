<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractMethodConstructionStrategy;
use spiral\framework\di\construction\Container;

/**
 * Mock for abstract Method construction strategy
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class MockAbstractMethodConstructionStrategy extends AbstractMethodConstructionStrategy
{
	public function buildMethod(Container $container, $currentService = null)
	{
	}
}
?>
