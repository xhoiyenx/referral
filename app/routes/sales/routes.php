<?php
Route::filter('auth.sales', function()
{
  if ( ! Auth::sales()->check() ) {
    if (Request::ajax()) {
      return Response::make('Unauthorized', 401);
    }
    else {
      return Redirect::route('sales.login');
    }
  }
});

# LOGIN PAGE
Route::match(['GET', 'POST'], 'login', [
  'as'    => 'sales.login', 
  'uses'  => 'Page\Auth@login',
]);

Route::get('logout', [
  'as'    => 'sales.logout', 
  'uses'  => 'Page\Auth@logout',
]);

# SALES AFTER LOGIN
Route::group(['before' => 'auth.sales'], function(){

	Route::get('/', [
	  'as'    => 'sales.dashboard', 
	  'uses'  => 'Page\Dashboard@index',
	]);

	Route::match(['GET', 'POST'], 'lead', [
	  'as'    => 'sales.lead', 
	  'uses'  => 'Lead\LeadController@index',
	]);

  Route::match(['GET', 'POST'], 'lead/{id}', [
    'as'    => 'sales.lead.profile', 
    'uses'  => 'Lead\LeadController@profile',
  ]);

  Route::post('lead/status/{id}', [
    'as'    => 'sales.lead.save_status', 
    'uses'  => 'Lead\LeadController@postStatus',
  ])->where('id', '[0-9]+');

});
