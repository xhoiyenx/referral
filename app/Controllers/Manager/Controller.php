<?php
namespace App\Controllers\Manager;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  protected $page_title;
  protected $breadcrumb;
  protected $use_header = true;

  public function __construct()
  {
    view()->addLocation( base_path() . '/app/views/backend' );
    view()->share('logout_url', route('admin.logout'));
    view()->share('main_menu', $this->mainMenu());
    view()->share('controller', $this);
  }

  private function mainMenu()
  {
    $menu = [
      'menu' => [
        'admin.dashboard' => [
          'name'    => 'Dashboard',
          'icon'    => 'fa-home',
          'active'  => app('router')->currentRouteName() == 'admin.dashboard' ? ' active' : ''
        ],
        'admin.solution' => [
          'name'    => 'Solutions',
          'icon'    => 'fa-gears',
          'active'  => app('router')->currentRouteName() == 'admin.solution' ? ' active' : ''
        ],
        'admin.member' => [
          'name'    => 'Members',
          'icon'    => 'fa-group',
          'active'  => app('router')->currentRouteName() == 'admin.member' ? ' active' : ''
        ],
        'admin.lead' => [
          'name'    => 'Leads',
          'icon'    => 'fa-group',
          'active'  => app('router')->currentRouteName() == 'admin.lead' ? ' active' : ''
        ],
        'admin.sales' => [
          'name'    => 'Sales Person',
          'icon'    => 'fa-user',
          'active'  => app('router')->currentRouteName() == 'admin.sales' ? ' active' : ''
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

  public function useHeader()
  {
    return $this->use_header;
  }

  public function setBreadcrumb( $breadcrumb )
  {
    return $this->breadcrumb = $breadcrumb;
  }

  public function drawBreadcrumb()
  {
    $html     = '';
    $default  = [
      'admin.dashboard' => 'Dashboard'
    ];

    if ( ! is_null($this->breadcrumb) )
      $default  += $this->breadcrumb;

    $html .= '<ol class="breadcrumb">';

    $i = 0;
    foreach ( $default as $route => $name )
    {
      $i++;

      $html .= '<li>';
      if ( $i == count($default) ) {
        $html .= $name;
      }
      else {
        $html .= '<a href="' . route($route) . '">' . $name . '</a>';
      }
      $html .= '</li>';
    }

    $html .= '</ol>';

    return $html;
  }  
}