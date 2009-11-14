<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;

/**
 * Test for Argument construction strategy abstract class
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractArgumentConstructionStrategyTest extends TestCase
{

	/**
	 * Test that the getArgument method return the right argument
	 */
	public function testGetExistingArgument()
	{
		$argument = $this->_getMockArgument('argumentName');
		$cs = $this->_getMockAbstractArgumentConstructionStrategy();
		$cs->setArgument($argument);

		$returnedArgument = $cs->getArgument();

		$this->assertSame($argument, $returnedArgument);
	}

	/**
	 * Test that when requesting an unexisting argument, an exception is thrown
	 *
	 * @expectedException spiral\framework\di\construction\exception\ArgumentNotSetException
	 */
	public function testUnexistingArgument()
	{
		$cs = $this->_getMockAbstractArgumentConstructionStrategy();
		$returnedArgument = $cs->getArgument();
	}
}
?>
