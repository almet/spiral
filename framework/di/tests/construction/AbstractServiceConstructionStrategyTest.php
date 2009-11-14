<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;

/**
 * Test for Service construction strategy abstract class
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractServiceConstructionStrategyTest extends TestCase
{

	/**
	 * Test that the the right Service is returned
	 */
	public function testGetExistingService()
	{
		$Service = $this->_getMockService();
		$cs = $this->_getMockAbstractServiceConstructionStrategy();
		$cs->setService($Service);

		$returnedService = $cs->getService();

		$this->assertSame($Service, $returnedService);
	}

	/**
	 * Test that when requesting an unexisting Service, an exception is thrown
	 *
	 * @expectedException spiral\framework\di\construction\exception\ServiceNotSetException
	 */
	public function testUnexistingService()
	{
		$cs = $this->_getMockAbstractServiceConstructionStrategy();
		$returnedService = $cs->getService();
	}
}
?>
