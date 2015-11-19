<?php
namespace App\Controllers\Client\Auth;

use App\Controllers\Client\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
  protected $user;

  public function __construct( UserRepository $user )
  {
    parent::__construct();
    $this->user = $user;

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
      'title' => 'Member Login'
    ];

    if ( request()->isMethod('post') )
    {
      extract( request()->all() );

      $role_id = 2; # ONLY FOR MEMBER

      # CODE BELOW WILL VALIDATE AGAINST USERNAME
      $success = app('auth')->once(['username' => $username, 'password' => $password, 'role_id' => $role_id]) OR app('auth')->once(['usermail' => $username, 'password' => $password, 'role_id' => $role_id]);
      #
      
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
          return redirect()->intended('clientzone');
        }
      }
      else {
        return redirect()->back()->withInput()->withErrors( 'Invalid credential info' );
      }
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

        if ( $user = $this->user->addNew( $input ) ) {
          # ASSIGN EMAIL EVENTS
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

  public function activate()
  {
    $code = request()->get('key');
    $user = $this->user->getByActivation( $code );
    
    if ( $user ) {
      $user->status = 1;
      $user->save();
    }

    $view = [
      'title' => 'Account Activation',
      'user'  => $user
    ];
    return view()->make('user.activation', $view);
  }

  public function reminder()
  {
    if ( request()->isMethod('post') )
    {
      $response = app('auth.reminder')->remind( request()->only('usermail'), function ($message) {
        $message->from( 'no-reply@itc2.clientsdemo.net', 'IT Concept Pte Ltd' );
        $message->subject( 'Password Reminder' );
      });

      switch ( $response ) {
        case 'reminders.user':
          return redirect()->back()->withInput()->withErrors( trans($response) );
          break;
        
        case 'reminders.sent':
          return redirect()->back()->withInput()->withMessage( trans($response) );
          break;
      }
    }

    $view = [
      'title' => 'Forgot Password',
    ];
    return view()->make('user.reminder', $view);
  }

  public function reset( $token = null )
  {
    if (is_null($token)) app()->abort(404);

    if ( request()->isMethod('post') )
    {
      $credentials = request()->only('usermail', 'password', 'password_confirmation', 'token');

      $response = app('auth.reminder')->reset($credentials, function($user, $password)
      {
        $user->password = app('hash')->make($password);
        $user->save();
      });

      switch ($response)
      {
        case 'reminders.password':
        case 'reminders.token':
        case 'reminders.user':
          return redirect()->back()->withInput()->withErrors( trans($response) );

        case 'reminders.reset':
          return redirect()->route('client.login')->withMessage( trans($response) );
      }
    }

    $view = [
      'title' => 'Pasword Reset',
      'token' => $token
    ];
    return view()->make('user.reset', $view);
  }

  public function logout()
  {
    auth()->logout();
    return redirect()->to('clientzone');
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