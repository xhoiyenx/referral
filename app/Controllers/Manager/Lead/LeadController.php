<?php
namespace App\Controllers\Manager\Lead;
use App\Controllers\Manager\Controller;
use App\Repositories\LeadRepository;
use App\Repositories\SolutionRepository;
use App\Repositories\SalesRepository;
use App\Repositories\MemberRepository;

class LeadController extends Controller
{
	use LeadControllerTrait;

  protected $lead;
  protected $sales;
  protected $member;
  protected $solution;
  public function __construct( MemberRepository $member, LeadRepository $lead, SolutionRepository $solution, SalesRepository $sales )
  {
    parent::__construct();
    $this->lead     = $lead;
    $this->solution = $solution;
    $this->sales    = $sales;
    $this->member   = $member;
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

    $view = [
      'members' => $this->member->query()->select('id', 'fullname', 'usermail', 'mobile')->where('status', 1)->orderBy('fullname', 'asc')->get(),
      'solutions' => $this->solution->all()
    ];

    return view()->make('user.lead.admin.index', $view);
	}

  public function sales( $sales_id = null )
  {
    if ( request()->ajax() )
    {
      return $this->ajaxlist( null, $sales_id );
    }
  }

	public function update( $id )
	{
    $this->setPageTitle('Edit Lead');
    
    $data = $this->lead->find($id);

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      if ( $data = $this->lead->save_status( $input, $data ) ) {
        session()->flash('message', 'Lead ' . $data->company . ' updated');
      }
    }

    $view = [
      'solutions' => $this->solution->solution_checkbox($data),
      'status' => $this->lead->statuses(),
      'sales' => ['' => 'Select sales person'] + $this->sales->query()->lists('fullname', 'id'),
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