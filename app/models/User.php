<?php
namespace App\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password', 'remember_token');

  public function usermeta()
  {
    return $this->hasMany('App\Models\UserMeta');
  }

  protected function validate( $data, $id = null, $register = true )
  {
    $rules = [
      'username'  => 'required|unique:user,username,' . $id,
      'usermail'  => 'required|email|unique:user,usermail,' . $id,
      'password'  => 'required|confirmed',
      'captcha'   => 'required|captcha',
    ];

    if ( $id != null ) {
      unset($rules['password']);
    }

    if ( ! $register ) {
      unset($rules['captcha']);
    }

    $validator = validator()->make( $data, $rules );
    return $validator;
  }
}