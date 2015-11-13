<?php
namespace App\Controllers\Client;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public function __construct()
  {
    view()->addLocation( base_path() . '/app/views/backend' );
  }
}