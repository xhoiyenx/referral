<?php
namespace App\Controllers\Site;

use App\Controllers\Site\Controller;
use App\Repositories\MemberRepository;
use App\Repositories\PageRepository;

class SiteController extends Controller
{
	protected $member;
	protected $page;
	public function __construct( MemberRepository $member, PageRepository $page )
	{
		parent::__construct();
		$this->member = $member;
		$this->page = $page;
		view()->share('testimonials', $this->page->queryByType('testimonial'));
	}

	public function getIndex()
	{
		$this->setPageTitle('Welcome');
		return view()->make('homepage');
	}

	public function getHowitworks()
	{
		$this->setPageTitle('How It Works');
		return view()->make('howitworks');
	}

	public function getWhyus()
	{
		$this->setPageTitle('Why Us');
		return view()->make('whyus');
	}

	public function getContact()
	{
		$this->setPageTitle('Contact');		
		return view()->make('contact');
	}

	public function getRegister()
	{
		$this->setPageTitle('Register');		
		return view()->make('register');
	}

	public function postRegister()
	{
  	$input = request()->all();
  	$validator = $this->member->validate_registration( $input );
		if ( $validator->fails() ) {
      return redirect()->back()->withInput()->withErrors( $validator );
    }
    else {
      if ( $user = $this->member->register( $input ) ) {
        # ASSIGN EMAIL EVENTS
        if ( app('events')->fire('member.registration', [$user]) ) {
        	return redirect()->to('registersuccess');
        }
      }
      else {
        return redirect()->back()->withInput()->withErrors('Failed inserting data');
      }
    }
	}

	public function getRegistersuccess()
	{
		$this->setPageTitle('Register Now');
		return view()->make('register')->with('registration_success', true);
	}

	public function missingMethod($parameters = [])
	{
		return view()->make('404');
		/*
		switch ($parameters[0]) {
			case 'admin':
			case 'clientzone':
				return view()->make('404');
				break;
			
			default:
				# code...
				break;
		}
		*/
	}
}