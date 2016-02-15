<?php
namespace App\Repositories;
use App\Models\Member;
use App\Models\Lead;

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

  public function validate_resend_activation( $input )
  {
    return Member::validate_resend_activation( $input );
  }

  public function validate_update( $input, $id )
  {
    return Member::validate_update( $input, $id );
  }

  public function validate_account( $data, $edit_password = false )
  {
    return Member::validate_account( $data, $edit_password );
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

  public function adminUpdate( Member $member, $input )
  {
    $member->fullname = $input['fullname'];
    $member->usermail = $input['usermail'];
    $member->mobile   = $input['mobile'];
    $member->address  = $input['address'];
    $member->status   = $input['status'];
    if ( $member->save() ) {
      return $member;
    }
    else {
      return false;
    }
  }

  public function getTotalByStatus( $status )
  {
    return $this->model->where('status', $status)->count();
  }

  public function queryOnlineMembers()
  {
    $query = $this->query();
    $query->where('online', 1);
    #$query->orWhereRaw('logged_at >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)');
    return $query;
  }

  public function getOnlineMembers()
  {
    $query = $this->queryOnlineMembers();
    return $query->get();
  }

  public function getByActivation( $code )
  {
    $user = Member::where('activation_code', $code)->first();
    return $user;
  }

  public function getTotalFee( Member $member )
  {
    $query = Lead::query();

    $query->leftJoin('lead_solutions', function($join) {
      $join->on('lead_solutions.lead_id', '=', 'leads.id');
    });

    $query->leftJoin('solutions', function($join) {
      $join->on('solutions.id', '=', 'lead_solutions.solution_id');
    });

    $query->where('leads.member_id', '=', $member->id);
    $query->select( db()->raw('lead_solutions.*, solutions.fee') );

    $rows = $query->get();

    if ( ! $rows->isEmpty() ) {
      $total = 0;
      foreach ( $rows as $item )
      {
        if ( ! is_null($item->custom_fee) ) {
          $total += $item->custom_fee;
        }
        else {
          $total += $item->fee;
        }
      }
      return $total;
    }
    else {
      return 0;
    }
  }

}