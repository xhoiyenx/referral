<?php
namespace App\Controllers\Sales\Lead;
use App\Controllers\Sales\Controller;
use App\Repositories\LeadRepository;
use App\Repositories\SolutionRepository;
use App\Repositories\SalesRepository;
use App\Repositories\MemberRepository;

class LeadController extends Controller
{
	use LeadControllerTrait;

  private $viewpage = [
    'index' => 'salespage.lead'
  ];

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
      return $this->ajaxlist( null, auth()->sales()->user()->id );
    }

    $this->setPageTitle('Lead');
    $this->setBreadcrumb([
      'sales.lead' => 'Lead'
    ]);

    $view = [
      'members'   => $this->member->query()->select('id', 'fullname', 'usermail', 'mobile')->where('status', 1)->orderBy('fullname', 'asc')->get(),
      'solutions' => $this->solution->all()
    ];

    return view()->make($this->viewpage['index'], $view);
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

    return view()->make('manager.lead.update', $view);
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
      'solutions' => $this->solution->all(),
      'statuses'  => $this->lead->statuses(),
      'sales'     => ['' => 'Select sales person'] + $this->sales->query()->lists('fullname', 'id'),
      'data' => $data,
    ];    

    return view()->make('salespage.lead-profile', $view);
  }

  public function postProfile( $id )
  {
    $solutions = null;

    $lead = $this->lead->find( $id );
    if ( ! $lead )
      return;

    $input = request()->all();

    # PARSE NEW FEE, IF EXISTS
    if ( request()->has('new_fee') ) {
      foreach ( $input['solutions'] as $solution ) {
        if ( isset( $input['new_fee'][$solution] ) ) {
          $solutions[$solution] = ['custom_fee' => $input['new_fee'][$solution]];
        }
        else {
          $solutions[$solution] = ['custom_fee' => null];
        }
      }
    }
    else {
      $solutions = $input['solutions'];
    }

    $lead->company      = $input['company'];
    $lead->fullname     = $input['fullname'];
    $lead->usermail     = $input['usermail'];
    $lead->phone        = $input['phone'];
    $lead->designation  = $input['designation'];
    $lead->introduce    = $input['introduce'];

    try {
      if ( $lead->save() ) {
        $lead->solutions()->sync( $solutions );
      }
    } catch (Exception $e) {
      return redirect()->back()->withErrors($e);
    }

    return redirect()->back()->with('message', 'Lead data updated');
  }

  public function postStatus( $id )
  {
    $lead = $this->lead->find( $id );
    if ( ! $lead )
      return;

    $input = request()->all();

    $save = $this->lead->save_history( $input, $lead );
    if ( $save ) {
      return redirect()->back()->with('message', 'Lead history added');
    }
  }
}