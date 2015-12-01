<?php
namespace App\Controllers\Manager\Lead;
use App\Controllers\Manager\Controller;
use App\Repositories\LeadRepository;
use App\Repositories\SolutionRepository;

class LeadController extends Controller
{
	use LeadControllerTrait;

  protected $lead;
  protected $solution;
  public function __construct( LeadRepository $lead, SolutionRepository $solution )
  {
    parent::__construct();
    $this->lead     = $lead;
    $this->solution = $solution;
  }

	public function index( $member_id = null )
	{
    if ( request()->ajax() )
    {
      return $this->ajaxlist( $member_id );
    }

    $this->setPageTitle('Lead');
    $this->setBreadcrumb([
      'admin.lead' => 'Lead'
    ]);

    return view()->make('user.lead.admin.index');
	}

	public function update( $id )
	{
    $this->setPageTitle('Edit Lead');
    
    $data = $this->lead->find($id);

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      if ( $this->lead->save_status( $input, $data ) ) {
        session()->flash('message', 'Lead ' . $data->company . ' status updated');
      }
    }

    $view = [
      'solutions' => $this->solution->solution_checkbox($data),
      'status' => $this->lead->statuses(),
      'data' => $data
    ];    

    return view()->make('user.lead.admin.create', $view);
	}

  public function profile( $id )
  {
    $data = $this->lead->find($id);

    $this->setPageTitle($data->company);
    $this->setBreadcrumb([
      'admin.lead' => 'Lead',
      '/' => $data->company
    ]);    

    $view = [
      'solutions' => $this->solution->solution_checkbox($data),
      'data' => $data,
    ];    

    return view()->make('user.lead.profile', $view);
  }
}