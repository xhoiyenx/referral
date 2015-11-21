<?php
namespace App\Repositories;
use App\Models\Solution;

class SolutionRepository
{
	/**
	 * Show solutions list based from user meta
	 */
	public function metaLists( $meta = null )
	{
		$coll = [];
		if ( ! empty( $meta ) )
		{
			$id 	= unserialize($meta);
			$coll = Solution::whereIn('id', $id)->lists('name');
		}

		return $coll;
	}
}