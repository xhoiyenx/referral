<?php
Route::filter('auth.clientzone', function()
{
  if ( ! Auth::member()->check() ) {
    if (Request::ajax()) {
      return Response::make('Unauthorized', 401);
    }
    else {
      return Redirect::route('client.login');
    }
  }
  else {
    if ( Auth::member()->get()->status == 3 ) {
      return Redirect::route('client.member.forced_profile');
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

#RESET PASSWORD PAGE
Route::match(['GET', 'POST'], 'user-profile', [
  'as'    => 'client.member.forced_profile', 
  'uses'  => 'Auth\AuthController@profile',
]);

#RESET PASSWORD PAGE
Route::match(['GET', 'POST'], 'resend', [
  'as'    => 'client.resend', 
  'uses'  => 'Auth\AuthController@resend',
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

  # SOLUTION INFO
  Route::get('solutions', [
    'as'    => 'client.solutions', 
    'uses'  => 'Dashboard\DashboardController@solutions',
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

  # LEAD UPDATE
  Route::match(['GET', 'POST'], 'lead/update/{id}', [
    'as'    => 'client.lead.update', 
    'uses'  => 'Lead\LeadController@update',
  ]);

  # CONTENT
  Route::get('page/{mode?}/{content?}', [
    'as'    => 'client.page', 
    'uses'  => 'Dashboard\DashboardController@page',
  ]);

  # ACCOUNT
  Route::match(['GET', 'POST'], 'my-account', [
    'as'    => 'client.account', 
    'uses'  => 'Dashboard\DashboardController@myaccount',
  ]);

});