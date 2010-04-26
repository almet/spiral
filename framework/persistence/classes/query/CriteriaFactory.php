<?php

namespace spiral\framework\persistence\query;

/**
 * Criteria factory
 * 
 * Create criteria from given parameters
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
interface CriteriaFactory
{
	/**
	 * Create criteria from other criteria with the given operator
	 * 
	 * @param	int			$operator	Logical operator to use
	 * @param	array		$criteria	Criteria to group
	 * 
	 * @return	Criteria	Criteria of other criteria created
	 */
	public function createCriteria($operator, array $criteria);
}