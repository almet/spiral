<?php

namespace spiral\framework\persistence\query;

/**
 * Criterion factory
 * 
 * Create criterion from given parameters
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface CriterionFactory
{
	/**
	 * Create criterion from given operator, attribute and value
	 * 
	 * @param	int			$operator	Logical operator to use
	 * @param	string		$attribute	Attribute name
	 * @param	mixed		$value		Value
	 * 
	 * @return	Criterion	Criterion created
	 */
	public function createCriterion($operator, $attribute, $value);
}