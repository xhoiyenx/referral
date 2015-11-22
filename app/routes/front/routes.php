<?php
Route::get('/', function()
{
	$query = App\Models\User::query();
  /*
  $query->select(db()->raw('COUNT(solutions.id) AS total_lead, SUM(solutions.fee) AS total_fee, member.*'));
  $query->join('user AS member', 'member.id', '=', 'user.parent');
  $query->join('user_solution', 'user_solution.user_id', '=', 'user.id');
  $query->join('solutions', 'user_solution.solution_id', '=', 'solutions.id');
  $query->where('member.role_id', 2);
  $query->groupBy('member.id');
  */
  
  /*
  $query->select(db()->raw('COUNT(lead.id) AS total_lead, SUM(solutions.fee) AS total_fee, user.*'));
  $query->join('user_solution', 'user_solution.user_id', '=', 'lead.id');
  $query->join('solutions', 'user_solution.solution_id', '=', 'solutions.id');
  $query->where('user.role_id', 2);
  $query->groupBy('user.id');
  */
  
  /*
  $query->select(db()->raw('COUNT(user.id) AS total_lead, SUM(solutions.fee) AS total_fee, member.*'));
  $query->join('user AS member', 'member.id', '=', 'user.parent');
  $query->join('user_solution', 'user.id', '=', 'user_solution.user_id');
  $query->join('solutions', 'user_solution.solution_id', '=', 'solutions.id');
  $query->where('member.role_id', 2);
  $query->groupBy('member.id');
  */
 
  /*
  $query->select(db()->raw('COUNT(user.id) AS total_lead, SUM(user_meta.value) AS total_fee, member.*'));
  $query->join('user AS member', 'member.id', '=', 'user.parent');
  $query->join('user_meta', function($join) {
    $join->on('user.id', '=', 'user_meta.user_id');
    $join->where('user_meta.attr', '=', 'total_fee');
  });
  $query->where('user.role_id', 3);
  $query->groupBy('user.parent');
  $query->orderBy('total_fee', 'asc');
  */

  $query->select(db()->raw('COUNT(lead.id) AS total_lead, SUM(user_meta.value) AS total_fee, user.*'));
  $query->join('user AS lead', 'lead.parent', '=', 'user.id');
  $query->join('user_meta', function($join) {
    $join->on('lead.id', '=', 'user_meta.user_id');
    $join->where('user_meta.attr', '=', 'total_fee');
  });
  $query->where('user.role_id', 2);
  $query->groupBy('user.id');
  $query->orderBy('total_fee', 'asc');

  dump($query->get()->toArray());

});