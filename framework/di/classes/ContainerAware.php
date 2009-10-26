<?php

namespace spiral\framework\di;

use \spiral\framework\di\construction\Container;

/**
 * Interface for objects that need to have an instance of the Di Container
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface ContainerAware
{
	/**
	 * Method used to store the container
	 * 
	 * @param	Container	$container		Dependency injection container
	 * @return	void
	 */
	public function setDIContainer(Container $container);
}
