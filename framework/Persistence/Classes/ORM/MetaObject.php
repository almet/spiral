<?php

namespace Spiral\Framework\Persistence\ORM;

/**
 * Meta object
 * 
 * A meta object is a meta representation of an in-memory object.
 * The transformation is possible thanks to the meta object transformer.
 * 
 * A meta object contains information that represent an in-memory object in order to store 
 * or to build an in-memory instance.
 * It is a much more easy to manage representation for relational needs or storage purpose in general.
 * 
 * Meta object information on the original instance are :
 * 	- The instantiation class
 * 	- The value and name of each attribute of the object
 * 
 * All attributes values must be atomic. That means that each relations to other objects 
 * have to be atomized (for example to an OID or a serialized representation).
 * 
 * @see			MetaObjectTransformer
 * 
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 * @copyright	Frédéric Sureau 2009
 * @license		http://www.gnu.org/licenses/gpl.html GNU General Public License V3
 */
interface MetaObject
{
	/**
	 * Return attributes as an associative array
	 * 
	 * The array is empty if there are no attributes.
	 * 
	 * @return	array	Associative array of all attributes names and values
	 */
	public function getAttributes();
	
	/**
	 * Return the instanciation class
	 * 
	 * @return	string	Full name of the class with namespace
	 */
	public function getClass();
	
	/**
	 * Define attributes by an associative array
	 * 
	 * The array is empty if there are no attributes.
	 * 
	 * @param	array	$attributes		Associative array of all attributes names and values.
	 * 
	 * @return	void
	 */
	public function setAttributes(array $attributes);
	
	/**
	 * Define the instanciation class
	 * 
	 * @param	string	Full name of the class with namespace
	 * 
	 * @return	void
	 */
	public function setClass($class);
}