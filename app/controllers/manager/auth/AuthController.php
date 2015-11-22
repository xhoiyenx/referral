<?php
namespace App\Controllers\Manager\Auth;

use App\Controllers\Manager\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
  protected $user;

  public function __construct( UserRepository $user )
  {
    parent::__construct();
    $this->user = $user;

    $this->create_admin();

    # REDIRECT LOGGED IN USER TO DASHBOARD
    /*
    if ( auth()->check() ) {
      redirect()->route('client.dashboard')->send();
    }
    */
  }

  public function login()
  {    
    $success = false;
    $view = [
      'title' => 'Administrator Login',
      'is_admin' => true
    ];

    if ( request()->isMethod('post') )
    {
      extract( request()->all() );

      $role_id = 1; # ONLY FOR ADMINISTRATOR

      # CODE BELOW WILL VALIDATE AGAINST USERNAME
      $success = app('auth')->once(['username' => $username, 'password' => $password, 'role_id' => $role_id]) OR app('auth')->once(['usermail' => $username, 'password' => $password, 'role_id' => $role_id]);
      
      if ( $success ) {
        $user = auth()->user();

        # USER NOT ACTIVATED YET, SEND ERROR
        if ( $user->status == 0 ) {
          return redirect()->back()->withInput()->withErrors( 'Your account not activated yet, please check your email for activation instructions' );
        }
        else
        if ( $user->status == 2 ) {
          return redirect()->back()->withInput()->withErrors( 'Your account is suspended. For assistance, please call +65 6850 5001 ; ext: 888.' );
        }
        else {
          auth()->login($user);
          return redirect()->intended('admin');
        }
      }
      else {
        return redirect()->back()->withInput()->withErrors( 'Invalid credential info' );
      }
    }

    return view()->make('user.login', $view);
  }

  public function logout()
  {
    auth()->logout();
    return redirect()->to('admin');
  }

  private function create_admin()
  {
  	if( User::where('role_id', 1)->count() < 1 ) {
  		$user = new User;
  		$user->role_id 	= 1;
  		$user->username = 'manager';
  		$user->usermail = 'manager@itconcept.sg';
  		$user->password = app('hash')->make('admin');
  		$user->save();
  	}
  }
}