<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
  protected $table = 'sales';
  protected $fillable = ['fullname', 'usermail', 'password', 'mobile'];

  protected function validate( $data, $id = null )
  {
    $messages = array(
      'fullname.required' => 'Name is required',
      'usermail.required' => 'Email is required',
      'usermail.unique'   => 'Email has already been taken',
      'mobile.required'   => 'Mobile number is required',
      'mobile.numeric'    => 'Mobile number needs all numeric',
    );

    $rules = [
      'fullname'  => 'required',
      'usermail'  => 'required|email|unique:sales,usermail,' . $id,
      'mobile'    => 'required|numeric',
      'password'  => 'required|confirmed'
    ];

    if ( ! is_null($id) )
      $rules['password'] = 'sometimes|confirmed';

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  public function lead()
  {
    return $this->hasMany('App\Models\Lead');
  }
}