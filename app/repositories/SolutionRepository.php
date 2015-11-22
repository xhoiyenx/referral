<?php
namespace App\Repositories;
use App\Models\Solution;

class SolutionRepository
{
	/**
	 * Show solutions list based from user meta
	 * $meta, serialized user meta data
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

	/**
	 * Get total referral fee by all selected solution
	 * $coll, ID of each solutions
	 */
	public function totalRefferalFee( $coll )
	{
		$data = Solution::whereIn('id', $coll)->sum('fee');
		if ( $data ) {
			return $data;
		}
	}
}