<?php

namespace spiral\framework\persistence\query;

/**
 * Default query factory
 * 
 * @author		Frédéric Sureau <fred@spiral-project.org>
 * @copyright	2009 Spiral-project.org <http://www.spiral-project.org>
 * @license		GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 */
class DefaultQueryFactory implements QueryFactory
{
	/**
	 * Create query
	 * 
	 * @return	Query	Query created
	 */
	public function createQuery()
	{
		$query = new DefaultQuery();
		
		$query->setCriteriaFactory( new DefaultCriteriaFactory() );
		$query->setCriterionFactory( new DefaultCriterionFactory() );
		
		return $query;
	}
}