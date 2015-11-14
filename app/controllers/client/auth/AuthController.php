<?php
namespace App\Controllers\Client\Auth;

use App\Controllers\Client\Controller;
use App\Models\User;
use App\Models\UserMeta;

class AuthController extends Controller
{
  public function login()
  {
    $view = [
      'title' => 'Member Login'
    ];

    if ( request()->isMethod('post') )
    {

    }

    return view()->make('user.login', $view);
  }

  public function registration( $status = '' )
  {
    if ( request()->isMethod('post') )
    {
    	$input = request()->all();
    	$validator = User::validate( $input );

    	# VALIDATE
			if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {

      	# INSERT USER DATA
      	$user = new User;
      	$user->role_id 		= 2; # ROLE ID member
      	$user->first_name = $input['first_name'];
      	$user->last_name 	= $input['last_name'];
      	$user->username 	= $input['username'];
      	$user->usermail 	= $input['usermail'];
      	$user->password 	= app('hash')->make($input['password']);
      	$user->status 		= 0;

      	if ( $user->save() ) {
      		# INSERT META DATA
      		foreach ( $input['meta'] as $key => $val ) {
      			$user->usermeta()->save( new UserMeta(['attr' => $key, 'value' => $val]) );
      		}

      		# ASSIGN EVENTS
      		app('events')->fire('member.registration', [$user]);

      		return redirect()->route('client.registration', ['status' => 'success']);
      	}
      	else {
      		return redirect()->back()->withInput()->withErrors('Failed inserting data');
      	}

      }
    }

    if ( $status == 'success' ) {
    	return $this->registration_success();
    }

    $view = [
      'title' => 'Member Registration'
    ];
    return view()->make('user.registration', $view);
  }

  private function registration_success()
  {
    $view = [
      'title' 	=> 'Registration Success',
      'success'	=> true
    ];
    return view()->make('user.registration', $view);
  }

  private function create_admin()
  {
  	if( User::count() < 1 ) {
  		$user = new User;
  		$user->role_id 	= 1;
  		$user->username = 'admin';
  		$user->usermail = 'hoiyen@itconcept.sg';
  		$user->password = app('hash')->make('admin');
  		$user->save();
  	}
  }
}