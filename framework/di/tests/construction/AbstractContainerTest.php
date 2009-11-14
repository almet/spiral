<?php
namespace spiral\framework\di\construction;

use spiral\framework\di\TestCase;

/**
 * Short description
 *
 * @author		Alexis Metaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */

class AbstractContainerTest extends TestCase
{
    public function testHasSharedService()
	{
		$container = $this->_getMockAbstractContainer();

		$this->assertFalse($container->hasSharedService('unexistant'));

		$container->addSharedService('existant', $this->_object);
		$this->assertTrue($container->hasSharedService('existant'));
	}

	/**
	 * @expectedException spiral\framework\di\construction\exception\InvalidSharedServiceException
	 */
	public function addInvalidSharedService()
	{
		$container = $this->_getMockAbstractContainer();
		$container->addSharedService('name', 'string');
	}

	public function addValidSharedService()
	{
		$container = $this->_getMockAbstractContainer();
		$container->addSharedService('name', $this->_object);
	}

	public function getExistantSharedService()
	{
		$container = $this->_getMockAbstractContainer();

		$container->addSharedService('object', $this->_object);
		$this->assertSame($container->getSharedSercice('object'),$this->_object);
	}

	public function getUnexistantSharedService()
	{
		$container = $this->_getMockAbstractContainer();
		$this->assertfalse($container->getSharedSercice('unexistant'));
	}
}
?>
