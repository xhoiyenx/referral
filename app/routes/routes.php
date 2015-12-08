<?php
# System Route
require_once __DIR__ . '/system.php';

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
	'namespace' => 'App\Controllers\Site'
], function()
{
	require_once __DIR__ . '/site/routes.php';
});