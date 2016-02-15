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

  protected function validate_account( $data, $edit_password = false )
  {
    $rules = [
      'mobile'    => 'required|numeric',
      'address'   => 'required',
      'old_password' => 'sometimes|passcheck|required_with:new_password,new_password_confirmation',
      'new_password' => 'sometimes|confirmed|required_with:old_password'
    ];

    $messages = array(
      'mobile.required'     => 'Mobile number is required',
      'mobile.numeric'      => 'Mobile number needs all numeric',
      'address.required'    => 'Address is required',
      'old_password.passcheck' => 'Invalid password'
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

  protected function validate_update( $input, $id )
  {
    $rules = [
      'fullname'  => 'required',
      'usermail'  => 'required|email|unique:members,usermail,' . $id,
      'mobile'    => 'required|numeric',
      'address'   => 'required'
    ];

    $messages = array(
      'fullname.required'   => 'Fullname is required',
      'usermail.required'   => 'Email is required',
      'usermail.confirmed'  => 'Email confirmation does not match.',
      'usermail.unique'     => 'Email has already been taken.',      
      'mobile.required'     => 'Mobile number is required',
      'mobile.numeric'      => 'Mobile number needs all numeric',
      'address.required'    => 'Address is required',
    );

    $validator = validator()->make( $input, $rules, $messages );
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