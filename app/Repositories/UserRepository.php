<?php
namespace App\Repositories;
use App\Repositories\SolutionRepository;
use App\Models\User;
use App\Models\UserMeta;

class UserRepository
{
  use UserRepositoryTrait;

  protected $solution;

  public function __construct()
  {
    $this->solution = new SolutionRepository;
  }

  public function leadStatus( $status )
  {
    switch ( $status ) {
      case '1':
        return 'Cold Lead';
        break;
      
      case '2':
        return 'Deal Closed';
        break;
      
      case '3':
        return 'Hot Lead';
        break;
      
      case '4':
        return 'Payment Received';
        break;
      
      case '5':
        return 'Warm Lead';
        break;
    }
  }

  public function addNew( $input )
  {
    $success = false;

    # INSERT USER DATA
    $user = new User;
    $user->role_id    = isset($input['role_id']) ? $input['role_id'] : 2; # ROLE ID member
    $user->fullname   = $input['fullname'];
    #$user->username   = $input['username'];
    $user->usermail   = $input['usermail'];
    $user->password   = app('hash')->make($input['password']);
    $user->status     = 0;
    $user->activation_code = app('hash')->make($input['usermail']);

    if ( $user->save() ) {
      # INSERT META DATA
      foreach ( $input['meta'] as $key => $val ) {
        if ( is_array($val) ) {
          $val = serialize($val);
        }
        $meta_old = ['user_id' => $user->id, 'attr' => $key];
        $meta_new = ['user_id' => $user->id, 'attr' => $key, 'value' => $val];
        $meta = UserMeta::updateOrCreate($meta_old, $meta_new);
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
        $meta_old = ['user_id' => $user->id, 'attr' => $key];
        $meta_new = ['user_id' => $user->id, 'attr' => $key, 'value' => $val];
        $meta = UserMeta::updateOrCreate($meta_old, $meta_new);
      }

      # INSERT META FOR TOTAL FEE, WILL BE EDITABLE BY ADMIN
      $fee_old = ['user_id' => $user->id, 'attr' => 'total_fee'];
      $fee_new = ['user_id' => $user->id, 'attr' => 'total_fee', 'value' => $this->solution->totalRefferalFee( $input['solutions'] )];
      UserMeta::updateOrCreate($fee_old, $fee_new);

      # INSERT PIVOT DATA
      $user->solutions()->sync( $input['solutions'] );
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

  public function getTotalLeadStatusByUser( $status, User $user )
  {
    $query = User::query();
    $query->join('user_meta', function($join) use ($status) {
      $join->on('user.id', '=', 'user_meta.user_id');
      $join->where('user_meta.attr', '=', 'status');
      $join->where('user_meta.value', '=', $status);
    });
    $query->where('user.parent', $user->id);
    return $query->count();
  }

}