<?php
namespace App\Controllers\Client\Auth;

use App\Controllers\Client\Controller;
use App\Models\User;

class AuthController extends Controller
{
  public function login()
  {
    $view = [
      'title' => 'Member Login'
    ];

    return view()->make('user.login', $view);
  }
}