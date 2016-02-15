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
		$this->setPageTitle( settings('homepage_title') );
		$view = [
			'meta_desc' => settings('homepage_description'),
			'meta_key'	=> settings('homepage_keywords')
		];
		return view()->make('homepage', $view);
	}

	public function getHowitworks()
	{
		$this->setPageTitle( settings('howitworks_title') );
		$view = [
			'meta_desc' => settings('howitworks_description'),
			'meta_key'	=> settings('howitworks_keywords')
		];
		return view()->make('howitworks', $view);
	}

	public function getWhyus()
	{
		$this->setPageTitle( settings('whyus_title') );
		$view = [
			'meta_desc' => settings('whyus_description'),
			'meta_key'	=> settings('whyus_keywords'),
			'faqs'			=> $this->page->queryByType('faq')
		];

		return view()->make('whyus', $view);
	}

	public function getContact()
	{
		$this->setPageTitle( settings('contact_title') );
		$view = [
			'meta_desc' => settings('contact_description'),
			'meta_key'	=> settings('contact_keywords'),
		];
		return view()->make('contact', $view);
	}

	public function getRegister()
	{
		$this->setPageTitle( settings('register_title') );
		$view = [
			'meta_desc' => settings('register_description'),
			'meta_key'	=> settings('register_keywords'),
		];
		return view()->make('register', $view);
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
		$view = [
			'meta_desc' => settings('register_description'),
			'meta_key'	=> settings('register_keywords'),
		];		
		return view()->make('register', $view)->with('registration_success', true);
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