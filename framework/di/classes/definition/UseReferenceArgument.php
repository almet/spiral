<?php

namespace spiral\framework\di\definition;

/**
 * Reference Argument : A reference to another service
 *
 * @author		Alexis Métaireau <alexis@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class UseReferenceArgument extends DefaultArgument
{
	// TODO Comment
	protected $_factoryMethod;
	protected $_referenceName;

	/**
	 * Constructor
	 *
	 * @param   string  $key
	 * @param   string  $factoryMethod  the factory method to call
	 * @return	void
	 */
	public function __construct($referenceName, $factoryMethod=null, $value=null)
	{
		$this->_referenceName = $referenceName;
		$this->_factoryMethod = $factoryMethod;
		$this->_value = $value;
	}

	/**
	 * Return the factory method to call in order to resolve the wanted value
	 *
	 * @return string
	 */
	public function getFactoryMethod()
	{
		return $this->_factoryMethod;
	}

	/**
	 * Return the service reference key
	 *
	 * @return  string
	 */
	public function getReference()
	{
		return $this->_referenceName;
	}
}
