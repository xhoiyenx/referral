<?php
namespace App\Controllers\Manager\Auth;

use App\Controllers\Manager\Controller;
use App\Models\Admin;

class AuthController extends Controller
{
  protected $user;

  public function __construct()
  {
    parent::__construct();
    $this->create_admin();
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

      # CODE BELOW WILL VALIDATE AGAINST USERNAME
      $success = auth()->admin()->attempt(['username' => $username, 'password' => $password]);
      
      if ( $success ) {
        return redirect()->intended('admin');
      }
      else {
        return redirect()->back()->withInput()->withErrors( 'Invalid credential info' );
      }
    }

    return view()->make('user.login', $view);
  }

  public function logout()
  {
    auth()->admin()->logout();
    return redirect()->to('admin');
  }

  private function create_admin()
  {
  	if( Admin::count() < 1 ) {
  		$user = new Admin;
  		$user->username = 'admin';
  		$user->password = app('hash')->make('admin');
  		$user->save();
  	}
  }
}