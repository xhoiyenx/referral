<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
  protected $fillable = ['fullname', 'usermail', 'company', 'phone', 'mobile', 'designation', 'status'];
  protected $appends  = array('solutions', 'set_fee', 'new_fee');

  protected function validate( $data, $id = null )
  {
    $messages = array(
      'company.required'  => 'Company name is required',
      'phone.required'    => 'Contact number is required',
      #'mobile.required'   => 'Mobile number is required',
      'phone.numeric'    => 'Contact number needs all numeric',
      #'mobile.numeric'   => 'Mobile number needs all numeric',
      'fullname.required' => 'Fullname is required',
      'tnc.accepted' => 'Please check terms and conditions',
      'introduce.required' => 'Please fill info on how will you introduce us',
      'solutions.required' => 'Please select one or more solutions available',
      'company.leadcheck' => 'You just add another lead with the same company name in last 24 hours'
    );

    $rules = [
      'fullname'=> 'required',
      'company' => 'required|leadcheck',
      'phone'   => 'required|numeric',
      #'mobile'  => 'required|numeric',
      'usermail' => 'sometimes|email',
      'tnc' => 'accepted',
      'introduce' => 'required',
      'solutions' => 'required'
    ];

    if ( ! is_null($id) ) {
      unset($rules['tnc']);
    }

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  public function getSolutionsAttribute()
  {
    return $this->solutions()->lists('id');
  }

  public function getSetFeeAttribute()
  {
    return $this->solutions()->whereNull('custom_fee', 'and', true)->lists('id');
  }

  public function getNewFeeAttribute()
  {
    return $this->solutions()->whereNull('custom_fee', 'and', true)->lists('custom_fee', 'id');
  }

  public function solutions()
  {
    return $this->belongsToMany('App\Models\Solution', 'lead_solutions');
  }

  public function member()
  {
    return $this->belongsTo('App\Models\Member');
  }

  public function sales()
  {
    return $this->belongsTo('App\Models\Sales');
  }

  public function history()
  {
    return $this->hasMany('App\Models\LeadHistory');
  }
}