<?php
namespace App\Controllers\Client\Dashboard;
use App\Controllers\Client\Controller;
use App\Repositories\SolutionRepository;
use App\Repositories\MemberRepository;

class DashboardController extends Controller
{
	protected $solution;
  protected $member;
  public function __construct( SolutionRepository $solution, MemberRepository $member )
  {
    parent::__construct();
    $this->solution = $solution;
    $this->member   = $member;
  }

  public function index()
  {
    return redirect()->route('client.lead');
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

  public function myaccount()
  {
    $this->setPageTitle('My Account');
    $this->setBreadcrumb([
      '/' => 'My Account'
    ]);

    $user = auth()->member()->user();

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->member->validate_account( $input );

      if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {
        if ( request()->has('new_password') ) {
          $user->password = app('hash')->make($input['new_password']);
        }
        $user->mobile   = $input['mobile'];
        $user->address  = $input['address'];
        $user->zipcode  = $input['zipcode'];
        $user->country  = $input['country'];

        if ( $user->save() ) {
          return redirect()->back()->with( 'message', 'Your account information has been updated' );
        }
      }
    }

    $view = [
      'data' => $user
    ];

    return view()->make('client.dashboard.account', $view);
  }
}