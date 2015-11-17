<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\UserMeta;

class UserRepository
{
  use UserRepositoryTrait;

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

  public function saveLead( $input, $user = null )
  {
    if ( $user == null )
      $user = new User;

    $user->role_id  = $input['role_id'];
    $user->fullname = $input['fullname'];
    $user->status   = 1;
    $user->parent   = auth()->id();

    if ( $user->save() )
    {
      # INSERT META DATA
      foreach ( $input['meta'] as $key => $val ) {
        $user->usermeta()->save( new UserMeta(['attr' => $key, 'value' => $val]) );
      }
    }

    return $user;
  }

  public function getUser()
  {
    $user = User::query();
  }

  public function getMeta( User $user, $key )
  {
    foreach ( $user->usermeta as $meta )
    {
      if ( $meta->attr == $key ) {
        return $meta->value;
      }
    }

    return '';
  }

  public function getChildren(User $user)
  {
    return $user->children()->get();
  }

  public function getByActivation( $code )
  {
    $user = User::where('activation_code', $code)->first();
    return $user;
  }

}