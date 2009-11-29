<?php

namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\AbstractArgumentConstructionStrategy;
use spiral\framework\di\construction\Container;

/**
 * Mock for abstract Argument construction strategy
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class MockAbstractArgumentConstructionStrategy extends AbstractArgumentConstructionStrategy
{
    
	public function buildArgument(Container $container, $currentService)
	{
	}
}
?>
