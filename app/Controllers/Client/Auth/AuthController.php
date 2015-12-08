<?php
namespace App\Controllers\Client\Auth;

use App\Controllers\Client\Controller;
use App\Models\Member;
use App\Repositories\MemberRepository;

class AuthController extends Controller
{
  protected $user;

  public function __construct( MemberRepository $user )
  {
    parent::__construct();
    $this->user = $user;
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

      $success = auth()->member()->once(['usermail' => $username, 'password' => $password]);
      
      if ( $success ) {
        $user = auth()->member()->get();

        # USER NOT ACTIVATED YET, SEND ERROR
        if ( $user->status == 0 ) {
          return redirect()->back()->withInput()->withErrors( 'Your account has not been activated. Please check your registered email (inbox and spam folders) to activate your account.<br><br> Please <a href="'.route('client.resend').'">click here</a> to resend the activation email if you don’t receive any activation email.' );
        }
        else
        if ( $user->status == 2 ) {
          return redirect()->back()->withInput()->withErrors( 'Your account is suspended. For assistance, please call +65 6850 5001 ; ext: 888.' );
        }
        else {
          auth()->member()->login($user);
          return redirect()->intended('clientzone/lead');
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
    	$validator = $this->user->validate_registration( $input );

    	# VALIDATE
			if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {

        if ( $user = $this->user->register( $input ) ) {
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
      $user->status = 3;
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
      $response = app('auth.reminder')->member()->remind( request()->only('usermail'), function ($message) {
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

      $response = app('auth.reminder')->member()->reset($credentials, function($user, $password)
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
      'title' => 'Reset Password',
      'token' => $token
    ];
    return view()->make('user.reset', $view);
  }

  public function logout()
  {
    auth()->member()->logout();
    return redirect()->route('client.login');
  }

  public function profile()
  {
    if ( ! auth()->member()->check() ) {
      return redirect()->route('client.login')->withErrors('Please login');
    }

    $user = auth()->member()->get();

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->user->validate_profile( $input );

      # VALIDATE
      if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {

        if ( $user = $this->user->saveProfile( $user, $input ) ) {
          #return redirect()->route('client.login')->with('message', 'Thank you, your account information is saved. Please proceed to log-in');
          app('events')->fire('member.member_activated', [$user]);
          return redirect()->route('client.dashboard');
        }
        else {
          return redirect()->back()->withInput()->withErrors('Failed updating data');
        }

      }
    }
    
    $view = [
      'title'   => 'Updating your account information',
      'user'    => $user
    ];
    return view()->make('user.user-profile', $view);
  }

  public function resend()
  {
    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->user->validate_resend_activation( $input );

      # VALIDATE
      if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {
        $member = $this->user->query()->where('usermail', $input['usermail'])->first();

        if ( ! $member ) {
          return redirect()->back()->withInput()->withErrors( "We can't find a user with that e-mail address." );
        }
        else {
          app('events')->fire('member.registration', [$member]);
          return redirect()->route('client.login')->with( 'message', 'We have sent your activation email' );
        }
      }
    }

    $view = [
      'title' => 'Resend your activation link',
    ];

    return view()->make('client.auth.activation-form', $view);
  }

  private function registration_success()
  {
    $view = [
      'title' 	=> 'Registration Success',
      'success'	=> true
    ];
    return view()->make('user.registration', $view);
  }
}