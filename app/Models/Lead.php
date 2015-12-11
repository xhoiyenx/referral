<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
  protected $fillable = ['fullname', 'company', 'phone', 'mobile', 'designation', 'status'];
  protected $appends  = array('solutions');

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
      'solutions.required' => 'Please select one or more solutions available'
    );

    $rules = [
      'fullname'=> 'required',
      'company' => 'required',
      'phone'   => 'required|numeric',
      #'mobile'  => 'required|numeric',
      'usermail' => 'email',
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
}