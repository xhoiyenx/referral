<?php
namespace App\Repositories;
use App\Models\Member;

class MemberRepository
{
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_SUSPENDED = 2;
  const STATUS_PENDING = 3;

  protected $model;
  public function __construct(Member $member)
  {
    $this->model = $member;
  }

  public function all()
  {
    return $this->model->all();
  }

  public function find( $value )
  {
    return $this->model->find( $value );
  }

  public function query()
  {
    return $this->model->query();
  }

  public function validate_registration( $input, $id = null, $register = true )
  {
    return Member::validate_registration( $input, $id, $register );
  }

  public function validate_profile( $input )
  {
    return Member::validate_profile( $input );
  }  

  public function addNew( $input )
  {
    # INSERT USER DATA
    $user = new Member;
    $user->fullname   = $input['fullname'];
    $user->usermail   = $input['usermail'];
    $user->password   = app('hash')->make($input['password']);
    $user->mobile     = $input['mobile'];
    $user->address    = $input['address'];
    $user->zipcode    = $input['zipcode'];
    $user->country    = $input['country'];
    $user->online     = 0;
    $user->status     = 0;
    $user->activation_code = md5($user->usermail);

    if ( $user->save() ) {
      return $user;
    }
  }

  public function register( $input )
  {
    # INSERT USER DATA
    $user = new Member;
    $user->usermail   = $input['usermail'];
    $user->password   = app('hash')->make($input['password']);
    $user->online     = 0;
    $user->status     = self::STATUS_INACTIVE;
    $user->activation_code = md5($user->usermail);
    if ( $user->save() ) {
      return $user;
    }    
  }

  public function saveProfile( Member $member, $input, $status = 1 )
  {
    $member->fullname = $input['fullname'];
    $member->mobile   = $input['mobile'];
    $member->address  = $input['address'];
    $member->zipcode  = $input['zipcode'];
    $member->country  = $input['country'];
    $member->status   = $status;
    if ( $member->save() ) {
      return $member;
    }
  }

  public function getByActivation( $code )
  {
    $user = Member::where('activation_code', $code)->first();
    return $user;
  }
}