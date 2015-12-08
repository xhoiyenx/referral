<?php
namespace App\Controllers\Manager\Member;
use App\Controllers\Manager\Controller;
use App\Repositories\MemberRepository;
use App\Repositories\SolutionRepository;

class MemberController extends Controller
{
  use MemberControllerTrait;
  
  protected $member;
  protected $solution;
  public function __construct( MemberRepository $member, SolutionRepository $solution )
  {
    parent::__construct();
    $this->member   = $member;
    $this->solution = $solution;
  }

  public function index()
  {
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $member = $this->member->find( request()->get('delete') );

        if ( $member ){
          $member->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

    $this->setPageTitle('Member');
    $this->setBreadcrumb([
      'admin.member' => 'Member'
    ]);

    $view = [
      'total_active'  => $this->member->getTotalByStatus(1),
      'total_pending' => $this->member->getTotalByStatus(0),
      'total_suspend' => $this->member->getTotalByStatus(2),
      'total_active_profile' => $this->member->getTotalByStatus(3),
      'total_members' => $this->member->query()->count(),
      'total_online'  => $this->member->queryOnlineMembers()->count()
    ];

    return view()->make('manager.member.index', $view);
  }

  public function update( $id )
  {
    $this->setPageTitle('Edit Member');
    $data = $this->member->find($id);
    $view = [
      'data' => $data
    ];    

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $validator = $this->member->validate_update( $input, $id );
      if ( $validator->fails() ) {
        request()->flash();
        return view()->make('manager.member.create', $view)->withInput($input)->withErrors($validator);
      }
      else {
        $this->member->adminUpdate( $data, $input );
        session()->flash('message', 'Member ' . $data->fullname . ' updated');
      }
    }

    return view()->make('manager.member.create', $view);
  }

  public function profile( $id )
  {
    $data = $this->member->find($id);

    $this->setPageTitle( $data->fullname . ' - Profile');
    $this->setBreadcrumb([
      'admin.member' => 'Member',
      '/' => $data->fullname,      
    ]);

    $view = [
      'data' => $data
    ];

    return view()->make('manager.member.profile', $view);
  }

  public function sendactivationemail( $id )
  {
    $data = $this->member->find($id);
    app('events')->fire('member.registration', [$data]);
    return redirect()->back()->with('message', 'Activation email has been sent to ' . $data->usermail);
  }
}