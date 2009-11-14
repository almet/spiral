<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;
use spiral\framework\di\construction\AbstractConstructionStrategy;

/**
 * Short description
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractConstructionStrategyTest extends TestCase
{
	/**
	 * Test that when no loader is defined, the load method does nothing
	 */
	public function testLoadMethodWithoutLoader()
	{
		// get the mocked implementation class
		$cs = $this->_getMockAbstractConstructionStrategy();
		$cs->load('className');
	}

	/**
	 * Test that when a loader is defined, it's called when calling the load
	 * method of the abstract construction strategy
	 */
	public function testLoadMethodWithLoader()
	{
		// get the mocked implementation class
		$cs = $this->_getMockAbstractConstructionStrategy();
		$loader = $this->_getMockLoader();
		$cs->setLoader($loader);
		$cs->load('className');

		$this->assertAttributeContains('className', 'loadAttributes', $loader);
	}
    
}
?>
