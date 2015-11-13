<?php
# Manager Route
Route::group([
	'namespace' => 'App\Controllers\Manager',
	'prefix' => 'manager'
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