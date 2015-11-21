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

#REGISTRATION PAGE
Route::match(['GET', 'POST'], 'registration/{status?}', [
  'as'    => 'client.registration', 
  'uses'  => 'Auth\AuthController@registration',
]);

#ACCOUNT ACTIVATION PAGE
Route::get('activate', [
  'as'    => 'client.activate', 
  'uses'  => 'Auth\AuthController@activate',
]);

#REMINDER PAGE
Route::match(['GET', 'POST'], 'reminder', [
  'as'    => 'client.reminder', 
  'uses'  => 'Auth\AuthController@reminder',
]);

#RESET PASSWORD PAGE
Route::match(['GET', 'POST'], 'reset/{token}', [
  'as'    => 'client.reset', 
  'uses'  => 'Auth\AuthController@reset',
]);

# CLIENTZONE AFTER LOGIN
Route::group(['before' => 'auth.clientzone'], function(){

  # LOGOUT
  Route::get('logout', [
    'as'    => 'client.logout',
    'uses'  => 'Auth\AuthController@logout',
  ]);

  # DASHBOARD
  Route::get('/', [
    'as'    => 'client.dashboard', 
    'uses'  => 'Dashboard\DashboardController@index',
  ]);

  # LEAD
  Route::match(['GET', 'POST'], 'lead', [
    'as'    => 'client.lead', 
    'uses'  => 'Lead\LeadController@index',
  ]);

  # LEAD CREATE
  Route::match(['GET', 'POST'], 'lead/create', [
    'as'    => 'client.lead.create', 
    'uses'  => 'Lead\LeadController@create',
  ]);  

  # LEAD CREATE
  Route::match(['GET', 'POST'], 'lead/update/{id}', [
    'as'    => 'client.lead.update', 
    'uses'  => 'Lead\LeadController@update',
  ]);

});