<?php
# MANAGER AFTER LOGIN
#Route::group(['before' => 'auth.clientzone'], function(){
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

  Route::match(['GET', 'POST'], 'solution/update/{id}', [
    'as'    => 'admin.solution.create', 
    'uses'  => 'Solution\SolutionController@update',
  ]);  
#});