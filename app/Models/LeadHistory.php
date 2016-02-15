<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LeadHistory extends Model
{
	protected $table = 'lead_history';

	public function sales()
	{
		if ( ! is_null($this->sales_id) ) {
			return $this->belongsTo('App\Models\Sales');
		}
		else {
			return false;
		}
	}
}