<?php
namespace App\Controllers\Client\Lead;
use App\Controllers\Client\Controller;

use App\Models\Lead;
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

	public function index()
	{
    if ( request()->ajax() )
    {
      return $this->ajaxlist( auth()->member()->id() );
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
      $validator = $this->lead->validate( $input );

      if ( $validator->fails() ) {
        request()->flash();
        session()->flash('errors', $validator);
      }
      else {
      	if ( $this->lead->save($input) ) {
          session()->flash('message', 'Lead ' . $input['company'] . ' created');
      	}
      }
    }

    $view = [
      'solutions' => $this->solution->solution_checkbox(),
    ];    

		return view()->make('user.lead.create', $view);
	}

  public function update( $id )
  {
    $this->setPageTitle('Edit Lead');
    
    $data = $this->lead->find($id);

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->lead->validate( $input );

      if ( $validator->fails() ) {
        request()->flash();
        session()->flash('errors', $validator);
      }
      else {
        if ( $this->lead->save($input, $data) ) {
          session()->flash('message', 'Lead ' . $data->company . ' updated');
        }
      }
    }

    $view = [
      'solutions' => $this->solution->solution_checkbox($data),
      'data' => $data
    ];    

    return view()->make('user.lead.create', $view);
  }
}