<?php
namespace App\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;
  protected $table    = 'user';
  protected $hidden   = array('password', 'remember_token');
  protected $appends  = array('meta');
  protected $primaryKey = 'id';

  protected function validate( $data, $id = null, $register = true )
  {
    $rules = [
      'fullname'  => 'required',
      #'username'  => 'required|unique:user,username,' . $id,
      'usermail'  => 'required|email|unique:user,usermail,' . $id,
      'password'  => 'required|confirmed',
      'captcha'   => 'required|captcha',
      'meta.mobile'  => 'required'
    ];

    $messages = array(
      'meta.company.required'  => 'Company name is required',
      'meta.phone.required'    => 'Phone number is required',
      'meta.mobile.required'   => 'Mobile number is required',
      'fullname.required'      => 'Fullname is required'
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

  protected function validate_lead( $data )
  {
    $messages = array(
      'meta.company.required'  => 'Company name is required',
      'meta.phone.required'    => 'Phone number is required',
      'meta.mobile.required'   => 'Mobile number is required',
      'fullname.required'      => 'Fullname is required'
    );

    $rules = [
      'fullname'     => 'required',
      'meta.company' => 'required',
      'meta.phone'   => 'required',
      'meta.mobile'  => 'required'
    ];

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

  public function getReminderEmail()
  {
    return $this->usermail;
  }

  public function getMetaAttribute()
  {
    return $this->usermeta()->lists('value', 'attr');
  }

  public function usermeta()
  {
    return $this->hasMany('App\Models\UserMeta');
  }

  public function children()
  {
    return $this->hasMany('App\Models\User', 'parent', 'id');
  }

  public function solutions()
  {
    return $this->belongsToMany('App\Models\Solution', 'user_solution');
  }  

  public function delete()
  {
    $this->usermeta()->delete();
    parent::delete();
  }
}