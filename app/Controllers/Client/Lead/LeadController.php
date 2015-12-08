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
		$this->setPageTitle('Lead');
    $this->setBreadcrumb([
      'client.lead' => 'Lead'
    ]);

    if ( request()->ajax() )
    {
      return $this->ajaxlist( auth()->member()->id() );
    }

		return view()->make('client.lead.index');
	}

	public function create()
	{
		$this->setPageTitle('Add New Lead');

    $view = [
      'solutions' => $this->solution->solution_checkbox(),
    ];    

    if ( request()->isMethod('post') )
    {
    	$input = request()->all();
      $validator = $this->lead->validate( $input );

      if ( $validator->fails() ) {
        request()->flash();
        return view()->make('client.lead.create', $view)->withInput($input)->withErrors($validator);
      }
      else {
      	if ( $this->lead->save($input) ) {
          session()->flash('message', 'Lead ' . $input['company'] . ' created');
      	}
      }
    }

		return view()->make('client.lead.create', $view);
	}

  public function update( $id )
  {
    $this->setPageTitle('Edit Lead');
    $data = $this->lead->find($id);
    $view = [
      'solutions' => $this->solution->solution_checkbox($data),
      'data' => $data
    ];    

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->lead->validate( $input );

      if ( $validator->fails() ) {
        request()->flash();
        return view()->make('client.lead.create', $view)->withInput($input)->withErrors($validator);
      }
      else {
        if ( $this->lead->save($input, $data) ) {
          request()->flash();
          $view['solutions'] = $this->solution->solution_checkbox($data);
          session()->flash('message', 'Lead ' . $data->company . ' updated');
        }
      }
    }

    return view()->make('client.lead.create', $view);
  }
}