<?php
namespace App\Controllers\Manager\Sales;
use App\Controllers\Manager\Controller;
use App\Repositories\SalesRepository;
use App\Models\Sales;

class SalesController extends Controller
{
  use SalesControllerTrait;

  protected $sales;
  public function __construct( SalesRepository $sales )
  {
    parent::__construct();
    $this->sales   = $sales;
  }

  public function index()
  {
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $data = $this->sales->find( request()->get('delete') );

        if ( $data ){
          $data->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

    $this->setPageTitle('Sales Person');
    $this->setBreadcrumb([
      'admin.sales' => 'Sales Person'
    ]);

    return view()->make('manager.sales.index');
  }

  public function create()
  {
    $this->setPageTitle('Add new sales person');
    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->sales->validate($input);
      if ( $validator->fails() ) {
        request()->flash();
        return view()->make('manager.sales.create')->withInput($input)->withErrors($validator);
      }
      else {
        $input['password'] = app('hash')->make($input['password']);
        $solution = $this->sales->create($input);
        if ($solution) {
          session()->flash('message', 'Sales ' . $input['fullname'] . ' added');
          return view()->make('manager.sales.create');
        }
      }
    }

    return view()->make('manager.sales.create');
  }

  public function update( $id )
  {
    $this->setPageTitle('Edit Sales');
    $data = $this->sales->find($id);

    $view = [
      'data' => $data
    ];

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->sales->validate($input, $id);
      if ( $validator->fails() ) {
        request()->flash();
        return view()->make('manager.sales.create')->withInput($input)->withErrors($validator);
      }
      else {
        if ( request()->has('password') ) {
          $input['password'] = app('hash')->make($input['password']);
        }
        $solution = $data->fill($input)->save();
        if ($solution) {
          session()->flash('message', 'Sales ' . $input['fullname'] . ' updated');
          return view()->make('manager.sales.create', $view);
        }
      }
    }

    return view()->make('manager.sales.create', $view);
  }

  public function leads( $lead_id = null )
  {
    $data = $this->sales->find($lead_id);
    $this->setPageTitle($data->fullname);
    $this->setBreadcrumb([
      'admin.sales' => 'Sales Person',
      '/' => $data->fullname
    ]);


    $view = [
      'data' => $data
    ];

    return view()->make('manager.sales.leads', $view);
  }
}