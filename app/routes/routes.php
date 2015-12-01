<?php
# Manager Route
Route::group([
	'namespace' => 'App\Controllers\Manager',
	'prefix' => Config::get('app.route_prefix.administrator')
], function()
{
	require_once __DIR__ . '/manager/routes.php';
});

# Clientzone Route
Route::group([
	'namespace' => 'App\Controllers\Client',
	'prefix' => 'clientzone'
], function()
{
	require_once __DIR__ . '/client/routes.php';
});

# Frontend Route
Route::group([
	'namespace' => 'App\Controllers\Front'
], function()
{
	require_once __DIR__ . '/front/routes.php';
});

# Installation and Upgrade
Route::get('install', function(){

});

Route::get('upgrade', function(){

	# CONTENTS MODULE
	Schema::create('page', function($table)
	{
	  $table->mediumInteger('id', true, true);
	  $table->mediumInteger('admin_id')->unsigned();
	  $table->string('type', 50);
	  $table->mediumText('title');
	  $table->text('description');
	  $table->string('slug', 100);	  
	  $table->string('status', 20);
	  $table->timestamps();
	});

	# SALES MODULE
	Schema::create('sales', function($table)
	{
	  $table->mediumInteger('id', true, true);
	  $table->string('fullname');	  
	  $table->string('usermail');
	  $table->string('mobile', 30);
	  $table->timestamps();
	});

});