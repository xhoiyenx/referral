<?php
namespace App\Controllers\Sales\Page;
use App\Controllers\Sales\Controller;

class Auth extends Controller
{
	private $viewpage = [
		'login' => 'salespage.login'
	];

  public function login()
  {    
    $success = false;
    $view = [
      'title' 		=> 'Sales Login',
      'is_sales' 	=> true
    ];

    if ( request()->isMethod('post') )
    {
      extract( request()->all() );

      # CODE BELOW WILL VALIDATE AGAINST USERNAME
      $success = auth()->sales()->attempt(['usermail' => $username, 'password' => $password]);
      
      if ( $success ) {
        return redirect()->intended('sales');
      }
      else {
        return redirect()->back()->withInput()->withErrors( 'Invalid credential info' );
      }
    }

    return view()->make( $this->viewpage['login'], $view );
  }

  public function logout()
  {
    auth()->sales()->logout();
    return redirect()->route('sales.login');
  }
}