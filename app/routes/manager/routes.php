<?php
Route::filter('auth.admin', function()
{
  if ( ! Auth::admin()->check() ) {
    if (Request::ajax()) {
      return Response::make('Unauthorized', 401);
    }
    else {
      return Redirect::route('admin.login');
    }
  }
});

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

  Route::match(['GET', 'POST'], 'member/update/{id?}', [
    'as'    => 'admin.member.update', 
    'uses'  => 'Member\MemberController@update',
  ]);

  Route::match(['GET', 'POST'], 'member/profile/{id}', [
    'as'    => 'admin.member.profile', 
    'uses'  => 'Member\MemberController@profile',
  ])->where('id', '[0-9]+');

  Route::get('member/sendactivationemail/{id}', [
    'as'    => 'admin.member.sendactivationemail', 
    'uses'  => 'Member\MemberController@sendactivationemail',
  ])->where('id', '[0-9]+');

  # LEADS PAGE
  Route::match(['GET', 'POST'], 'lead/{member_id?}', [
    'as'    => 'admin.lead', 
    'uses'  => 'Lead\LeadController@index',
  ])->where('member_id', '[0-9]+');

  # LEADS PAGE
  Route::match(['GET', 'POST'], 'lead/sales/{sales_id}', [
    'as'    => 'admin.lead.sales', 
    'uses'  => 'Lead\LeadController@sales',
  ])->where('sales_id', '[0-9]+');

  Route::match(['GET', 'POST'], 'lead/update/{id?}', [
    'as'    => 'admin.lead.update', 
    'uses'  => 'Lead\LeadController@update',
  ]);

  Route::match(['GET', 'POST'], 'lead/profile/{id}', [
    'as'    => 'admin.lead.profile', 
    'uses'  => 'Lead\LeadController@profile',
  ])->where('id', '[0-9]+');

  # SALES PERSON PAGE
  Route::match(['GET', 'POST'], 'sales', [
    'as'    => 'admin.sales', 
    'uses'  => 'Sales\SalesController@index',
  ]);

  Route::match(['GET', 'POST'], 'sales/update/{id?}', [
    'as'    => 'admin.sales.update', 
    'uses'  => 'Sales\SalesController@update',
  ]);

  Route::match(['GET', 'POST'], 'sales/create', [
    'as'    => 'admin.sales.create', 
    'uses'  => 'Sales\SalesController@create',
  ]);

  Route::match(['GET', 'POST'], 'sales/leads/{id}', [
    'as'    => 'admin.sales.leads',
    'uses'  => 'Sales\SalesController@leads',
  ])->where('id', '[0-9]+');

  # TESTIMONIALS PAGE
  Route::match(['GET', 'POST'], 'testimonials', [
    'as'    => 'admin.testimonials',
    'uses'  => 'Testimonial\TestimonialController@index',
  ]);

  Route::match(['GET', 'POST'], 'testimonials/update/{id?}', [
    'as'    => 'admin.testimonials.update', 
    'uses'  => 'Testimonial\TestimonialController@update',
  ])->where('id', '[0-9]+');

  Route::match(['GET', 'POST'], 'testimonials/create', [
    'as'    => 'admin.testimonials.create', 
    'uses'  => 'Testimonial\TestimonialController@create',
  ]);

  # CONFIGURATION PAGE
  Route::get('configuration/{mode?}', [
    'as'    => 'admin.configuration', 
    'uses'  => 'Config\ConfigController@index',
  ]);

  Route::post('configuration/save', [
    'as'    => 'admin.configuration.save', 
    'uses'  => 'Config\ConfigController@save',
  ]);

});