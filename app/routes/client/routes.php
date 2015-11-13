<?php
Route::filter('auth.clientzone', function()
{
  if (Auth::guest())
  {
    if (Request::ajax())
    {
      return Response::make('Unauthorized', 401);
    }
    else
    {
      return Redirect::guest('clientzone/login');
    }
  }
});

# LOGIN PAGE
Route::match(['GET', 'POST'], 'login', [
  'as'    => 'client.login', 
  'uses'  => 'Auth\AuthController@login',
]);

# CLIENTZONE NEED AUTH
Route::group(['before' => 'auth.clientzone'], function(){

  # DASHBOARD
  Route::get('/', [
    'as'    => 'client.dashboard', 
    'uses'  => 'Dashboard\DashboardController@index',
  ]);

});