<?php
namespace App\Controllers\Manager\Config;
use App\Controllers\Manager\Controller;

class ConfigController extends Controller
{
	protected $mode = [
		'general',
		'content'
	];

	public function __construct()
	{
		parent::__construct();
	}

	public function index( $mode = 'general' )
	{
		$this->setPageTitle( ucfirst($mode) . ' Configuration');

		$view = [
			'data' 	=> ['config' => settings()->all()],
			'tabs'	=> $this->mode,
			'mode'	=> $mode
		];

		try {
			return view()->make('manager.configuration.' . $mode, $view);
		} catch (\InvalidArgumentException $e) {
			return view()->make('404');
		}
	}

	public function save()
	{
		$input = request()->get('config');
		settings()->save($input);
		return redirect()->back()->withInput()->with('message', 'Configuration updated');
	}	
}