<?php
namespace App\Controllers\Client\Dashboard;
use App\Controllers\Client\Controller;
use App\Repositories\SolutionRepository;

class DashboardController extends Controller
{
	protected $solution;	
  public function __construct( SolutionRepository $solution )
  {
    parent::__construct();
    $this->solution = $solution;
  }

  public function index()
  {
  	$this->setPageTitle('Dashboard');
    return view()->make('client.dashboard.index');
  }

  public function solutions()
  {
    $this->setPageTitle('Our Solutions');
    $this->setBreadcrumb([
      '/' => 'Our Solutions'
    ]);

    $view = [
    	'solutions' => $this->solution->all()
    ];

    return view()->make('solution.list', $view);
  }  
}