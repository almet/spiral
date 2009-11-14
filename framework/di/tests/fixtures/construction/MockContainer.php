<?php
namespace spiral\framework\di\fixtures\construction;

use spiral\framework\di\construction\DefaultContainer;
/**
 * Mock service used in tests
 *
 * @author  	Alexis Métaireau	29 sept. 2009
 * @copyright	Alexis Metaireau 	2009
 * @license		GNU/GPL V3. Please see the COPYING FILE.
 */

class MockContainer extends DefaultContainer
{
	public $getServiceArguments = array();

	public function getService($name)
	{
		$this->getServiceArguments = array($name);
		return parent::getService($name);
	}
	
}
?>
