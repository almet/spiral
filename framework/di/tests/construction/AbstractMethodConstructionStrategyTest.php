<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;

/**
 * Test for Method construction strategy abstract class
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractMethodConstructionStrategyTest extends TestCase
{

	/**
	 * Test that the the right method is returned
	 */
	public function testGetExistingMethod()
	{
		$method = $this->_getMockMethod('methodName');
		$cs = $this->_getMockAbstractMethodConstructionStrategy();
		$cs->setMethod($method);

		$returnedMethod = $cs->getMethod();

		$this->assertSame($method, $returnedMethod);
	}

	/**
	 * Test that when requesting an unexisting method, an exception is thrown
	 *
	 * @expectedException spiral\framework\di\construction\exception\MethodNotSetException
	 */
	public function testUnexistingMethod()
	{
		$cs = $this->_getMockAbstractMethodConstructionStrategy();
		$returnedMethod = $cs->getMethod();
	}
}
?>
