<?php
namespace App\Controllers\Manager\Solution;
use App\Controllers\Manager\Controller;

class SolutionController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
		$this->setPageTitle('Solutions');
    $this->setBreadcrumb([
      'admin.solution' => 'Solutions'
    ]);
    return view()->make('solution.index');
  }

  public function create()
  {

  }

  public function update()
  {
  	
  }
}