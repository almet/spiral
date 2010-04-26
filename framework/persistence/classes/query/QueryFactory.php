<?php

namespace spiral\framework\persistence\query;

/**
 * Query factory
 * 
 * Create query from given parameters.
 * 
 * Typically used by an {@link ObjectRepository} to create {@link Query}.
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface QueryFactory
{
	/**
	 * Create query
	 * 
	 * @return	Query	Query created
	 */
	public function createQuery();
}