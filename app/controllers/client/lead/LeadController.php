<?php
namespace App\Controllers\Client\Lead;
use App\Controllers\Client\Controller;
use App\Repositories\UserRepository;
use App\Repositories\SolutionRepository;
use App\Models\User;

class LeadController extends Controller
{
  use LeadControllerTrait;

  protected $user;
  protected $solution;
	public function __construct( UserRepository $user, SolutionRepository $solution )
	{
		parent::__construct();
		$this->user = $user;
    $this->solution = $solution;
	}

	public function index()
	{
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $user = User::find( request()->get('delete') );

        if ( $user ){
          $user->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

		$this->setPageTitle('Lead');
    $this->setBreadcrumb([
      'client.lead' => 'Lead'
    ]);

		return view()->make('user.lead.index');
	}

	public function create()
	{
		$this->setPageTitle('Add New Lead');

    if ( request()->isMethod('post') )
    {
    	$input = request()->all();
      $validator = User::validate_lead( $input );

      if ( $validator->fails() ) {
        request()->flash();
        session()->flash('errors', $validator);
        #return view()->make('user.lead.create', $view)->withErrors($validator);
      }
      else {
      	if ( $this->user->saveLead($input) ) {
          session()->flash('message', 'Lead ' . $input['meta']['company'] . ' created');
      	}
      }
    }

    $view = [
      'solutions' => $this->solution_checkbox()
    ];    

		return view()->make('user.lead.create', $view);
	}

  public function update( $id )
  {
    $this->setPageTitle('Edit Lead');
    
    $data = User::find($id);

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = User::validate_lead( $input );

      if ( $validator->fails() ) {
        request()->flash();
        session()->flash('errors', $validator);
      }
      else {
        if ( $this->user->saveLead($input, $data) ) {
          session()->flash('message', 'Lead ' . $input['meta']['company'] . ' updated');
        }
      }
    }

    $view = [
      'solutions' => $this->solution_checkbox($data),
      'data' => $data
    ];    

    return view()->make('user.lead.create', $view);
  }
}