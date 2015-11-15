<?php
namespace App\Controllers\Client\Dashboard;
use App\Controllers\Client\Controller;

class DashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    #dump( app('router')->currentRouteName() );
    return view()->make('dashboard.index');
  }
}