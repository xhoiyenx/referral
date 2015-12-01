<?php
namespace App\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model;

class Member extends Model implements UserInterface, RemindableInterface
{
  use UserTrait, RemindableTrait;
  protected $hidden   = array('password', 'remember_token');

  protected function validate_registration( $data, $id = null, $register = true )
  {
    $rules = [
      'usermail'  => 'required|confirmed|email|unique:members,usermail,' . $id,
      'password'  => 'required|confirmed',
      'captcha'   => 'required|captcha',
    ];

    $messages = array(
    	'usermail.required'	  => 'Email is required',
      'usermail.confirmed'  => 'Email confirmation does not match.',
      'usermail.unique'     => 'Email has already been taken.'
    );    

    if ( $id != null ) {
      unset($rules['password']);
    }

    if ( ! $register ) {
      unset($rules['captcha']);
    }

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  protected function validate_profile( $data )
  {
    $rules = [
      'fullname'  => 'required',
      'mobile'    => 'required|numeric',
      'address'   => 'required',
      'captcha'   => 'required|captcha',
    ];

    $messages = array(
      'fullname.required'   => 'Fullname is required',
      'mobile.required'     => 'Mobile number is required',
      'mobile.numeric'      => 'Mobile number needs all numeric',
      'address.required'    => 'Address is required',
    );    

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  protected function validate_resend_activation( $data )
  {
    $rules = [
      'usermail'  => 'required|email'
    ];

    $messages = array(
      'usermail.required'   => 'Email is required',
      'usermail.confirmed'  => 'Email confirmation does not match.',
      'usermail.unique'     => 'Email has already been taken.'
    );    

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  public function getReminderEmail()
  {
    return $this->usermail;
  }

  public function leads()
  {
    return $this->hasMany('App\Models\Lead');
  }
}