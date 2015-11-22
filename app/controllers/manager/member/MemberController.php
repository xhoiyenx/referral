<?php
namespace App\Controllers\Manager\Member;
use App\Controllers\Manager\Controller;
use App\Repositories\UserRepository;
use App\Repositories\SolutionRepository;
use App\Models\User;

class MemberController extends Controller
{
  use MemberControllerTrait;
  
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

    $this->setPageTitle('Member');
    $this->setBreadcrumb([
      'admin.member' => 'Member'
    ]);

    return view()->make('user.member.index');
  }
}