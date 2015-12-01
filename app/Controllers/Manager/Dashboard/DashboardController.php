<?php
namespace App\Controllers\Manager\Dashboard;
use App\Controllers\Manager\Controller;


class DashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->setPageTitle('Dashboard');
    return view()->make('dashboard.index');
  }
}