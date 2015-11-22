<?php
# LOGIN PAGE
Route::match(['GET', 'POST'], 'login', [
  'as'    => 'admin.login', 
  'uses'  => 'Auth\AuthController@login',
]);

# MANAGER AFTER LOGIN
Route::group(['before' => 'auth.admin'], function(){

  # LOGOUT
  Route::get('logout', [
    'as'    => 'admin.logout',
    'uses'  => 'Auth\AuthController@logout',
  ]);

  # DASHBOARD
  Route::get('/', [
    'as'    => 'admin.dashboard', 
    'uses'  => 'Dashboard\DashboardController@index',
  ]);

  # SOLUTIONS PAGE
  Route::match(['GET', 'POST'], 'solution', [
    'as'    => 'admin.solution', 
    'uses'  => 'Solution\SolutionController@index',
  ]);

  Route::match(['GET', 'POST'], 'solution/create', [
    'as'    => 'admin.solution.create', 
    'uses'  => 'Solution\SolutionController@create',
  ]);

  Route::match(['GET', 'POST'], 'solution/update/{id?}', [
    'as'    => 'admin.solution.update', 
    'uses'  => 'Solution\SolutionController@update',
  ]);

  # MEMBERS PAGE
  Route::match(['GET', 'POST'], 'member', [
    'as'    => 'admin.member', 
    'uses'  => 'Member\MemberController@index',
  ]);
});