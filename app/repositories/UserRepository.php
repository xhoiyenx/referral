<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\UserMeta;

class UserRepository
{

  public function addNew( $input )
  {
    $success = false;

    # INSERT USER DATA
    $user = new User;
    $user->role_id    = isset($input['role_id']) ? $input['role_id'] : 2; # ROLE ID member
    $user->fullname   = $input['fullname'];
    $user->username   = $input['username'];
    $user->usermail   = $input['usermail'];
    $user->password   = app('hash')->make($input['password']);
    $user->status     = 0;
    $user->activation_code = app('hash')->make($input['usermail']);

    if ( $user->save() ) {
      # INSERT META DATA
      foreach ( $input['meta'] as $key => $val ) {
        $user->usermeta()->save( new UserMeta(['attr' => $key, 'value' => $val]) );
      }
    }

    return $user;
  }

  public function getByActivation( $code )
  {
    $user = User::where('activation_code', $code)->first();
    return $user;
  }

}