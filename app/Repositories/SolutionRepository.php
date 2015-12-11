<?php
namespace App\Repositories;
use App\Models\Lead;
use App\Models\Solution;

class SolutionRepository
{
  protected $model;
  public function __construct(Solution $solution)
  {
    $this->model = $solution;
  }

  public function all()
  {
    return $this->model->orderBy('sort_order')->get();
  }

  public function find( $value )
  {
    return $this->model->find( $value );
  }

  public function query()
  {
    return $this->model->query();
  }

  public function validate( $input )
  {
    return Solution::validate( $input );
  }

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

  public function solution_checkbox( Lead $lead = null )
  {
    $selected = [];
    if ( $lead != null ) {
      $selected  = $lead->solutions()->orderBy('sort_order')->lists('solution_id');
    }

    if ( request()->isMethod('post') ) {
      if ( request()->has('solutions') ) {
        $selected = request()->get('solutions');
      }
    }

    $solutions = $this->all();
    $html = '';
    foreach ( $solutions as $solution )
    {
      $html .= '<div class="checkbox">';
      $html .= form()->checkbox('solutions[]', $solution->id, in_array($solution->id, $selected), ['id' => 'cb_' . $solution->id]);
      $html .= form()->label('cb_' . $solution->id, $solution->name);
      $html .= '</div>';
    }
    return $html;
  }	
}