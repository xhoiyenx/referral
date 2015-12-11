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

    return view()->make('client.solution.list', $view);
  }

  public function page( $mode = null, $content = null )
  {
    $contents = '';

    switch ($mode) {
      case 'tnc':
        $this->setPageTitle('Terms & Conditions');
        $this->setBreadcrumb([
          '/' => 'Terms & Conditions'
        ]);
        $contents = settings('tnc');
        break;
    }

    $view = [
      'content' => $contents
    ];

    # VIEW SOLUTIONS ON MODAL
    if ( request()->ajax() && $mode == 'solution' ) {
      $data = $this->solution->find( $content );
      $this->setPageTitle($data->name);
      $view['data'] = $data;
      return view()->make('client.solution.content', $view);
    }
    
    return view()->make('client.page.index', $view);
  }
}