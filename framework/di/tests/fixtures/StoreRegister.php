<?php

namespace spiral\framework\di\fixtures;

/**
 * Represent a store register as static class. 
 * 
 * This exemple is only there for test purpose, this kind of design should not be 
 * implemented because of evil direct dependencies.
 * 
 * @author	Frédéric Sureau <frederic.sureau@gmail.com>
 */
class StoreRegister
{
	public static $stores = array();
	
	public static function register(Store $store)
	{
		self::$stores[] = $store;
	}
}
