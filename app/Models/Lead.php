<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
  protected $fillable = ['fullname', 'company', 'phone', 'mobile', 'designation', 'status'];

  protected function validate( $data )
  {
    $messages = array(
      'company.required'  => 'Company name is required',
      'phone.required'    => 'Phone number is required',
      'mobile.required'   => 'Mobile number is required',
      'fullname.required' => 'Fullname is required'
    );

    $rules = [
      'fullname'=> 'required',
      'company' => 'required',
      'phone'   => 'required',
      'mobile'  => 'required'
    ];

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
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
    return $this->hasOne('App\Models\Sales');
  }  
}