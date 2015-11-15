<?php
namespace App\Controllers\Client;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public function __construct()
  {
    view()->addLocation( base_path() . '/app/views/backend' );
    view()->share('logout_url', route('client.logout'));
    view()->share('main_menu', $this->mainMenu());
  }

  private function mainMenu()
  {
    $menu = [
      'menu' => [
        'client.dashboard' => [
          'name'    => 'Dashboard',
          'icon'    => 'fa-home',
          'active'  => app('router')->currentRouteName() == 'client.dashboard' ? ' active' : ''
        ]
      ]
    ];

    return $menu;
  }
}