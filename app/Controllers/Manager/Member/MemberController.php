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

    return view()->make('user.member.index');
  }

  public function update( $id )
  {
    $this->setPageTitle('Edit Member');
    
    $data = $this->member->find($id);

    if ( request()->isMethod('post') )
    {
      $input = request()->all();
      $data->status = $input['status'];
      $data->save();
      session()->flash('message', 'Member ' . $data->fullname . ' updated');
    }

    $view = [
      'data' => $data
    ];    

    return view()->make('user.member.create', $view);
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

    return view()->make('user.member.profile', $view);
  }
}