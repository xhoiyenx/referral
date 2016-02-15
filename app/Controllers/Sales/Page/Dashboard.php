<?php
namespace App\Controllers\Sales\Page;
use App\Controllers\Sales\Controller;

class Dashboard extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

  public function index()
  {
    $this->setPageTitle('Dashboard');
    return view()->make('salespage.dashboard');
  }
}