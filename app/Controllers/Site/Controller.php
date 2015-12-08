<?php
namespace App\Controllers\Site;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  protected $page_title;

  public function __construct()
  {
    view()->addLocation( public_path() . '/site' );
    view()->share('controller', $this);
  }

  private function mainMenu()
  {
    $menu = [
      'menu' => [
        'client.dashboard' => [
          'name'    => 'Dashboard',
          'icon'    => 'fa-home',
          'active'  => app('router')->currentRouteName() == 'client.dashboard' ? ' active' : ''
        ],
        'client.lead' => [
          'name'    => 'Leads',
          'icon'    => 'fa-group',
          'active'  => app('router')->currentRouteName() == 'client.lead' ? ' active' : ''
        ],
        'client.solutions' => [
          'name'    => 'Our Solutions',
          'icon'    => 'fa-cogs',
          'active'  => app('router')->currentRouteName() == 'client.solutions' ? ' active' : ''
        ],
      ]
    ];

    return $menu;
  }

  public function getPageTitle()
  {
    return $this->page_title;
  }

  public function setPageTitle( $title )
  {
    $this->page_title = $title;
  }
}