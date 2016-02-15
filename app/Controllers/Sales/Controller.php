<?php
namespace App\Controllers\Sales;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  protected $page_title;
  protected $breadcrumb;
  protected $use_header = true;

  public function __construct()
  {
    view()->addLocation( base_path() . '/app/views/backend' );
    view()->share('logout_url', route('sales.logout'));
    view()->share('main_menu', $this->mainMenu());
    view()->share('controller', $this);
  }

  private function mainMenu()
  {
    $menu = [
      'menu' => [
        'sales.dashboard' => [
          'name'    => 'Dashboard',
          'icon'    => 'fa-home',
          'active'  => app('router')->currentRouteName() == 'sales.dashboard' ? ' active' : ''
        ],
        'sales.lead' => [
          'name'    => 'Leads',
          'icon'    => 'fa-user-plus',
          'active'  => app('router')->currentRouteName() == 'sales.lead' ? ' active' : ''
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