<?php

namespace spiral\framework\persistence\query;

/**
 * Default criteria factory
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultCriteriaFactory implements CriteriaFactory
{
	/**
	 * Create criteria from other criteria with the given operator
	 * 
	 * @param	int			$operator			Logical operator to use
	 * @param	array		$criteriaArray		Array of criteria to group
	 * 
	 * @return	Criteria	Criteria of other criteria created
	 */
	public function createCriteria($operator, array $criteriaArray)
	{
		$criteria = new DefaultCriteria();
		
		$criteria->setCriteriaOperator($operator);
		$criteria->setCriteriaArray($criteriaArray);
		
		return $criteria;
	}
}