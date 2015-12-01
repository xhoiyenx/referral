<?php
namespace App\Controllers\Client;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  protected $page_title;
  protected $breadcrumb;
  protected $use_header = true;

  public function __construct()
  {
    view()->addLocation( base_path() . '/app/views/backend' );
    view()->share('logout_url', route('client.logout'));
    view()->share('main_menu', $this->mainMenu());
    view()->share('controller', $this);

    if ( auth()->member()->check() )
    {
      if ( auth()->member()->get()->status == 2 ) {
        auth()->logout();
        return redirect()->route('client.login')->withErrors( 'Your account is suspended. For assistance, please call +65 6850 5001 ; ext: 888.' )->send();
      }
    }
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
      'client.dashboard' => 'Dashboard'
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