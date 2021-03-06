<?php
function auth()
{
  return app('auth');
}

function db()
{
  return app('db');
}

function form()
{
  return app('form');
}

function view()
{
  return app('view');
}

function request()
{
  return app('request');
}

function response()
{
  return Response;
}

function redirect()
{
	return app('redirect');
}

function html()
{
  return app('html');
}

function session()
{
  return app('session');
}

function settings( $key = null )
{
  if ( ! is_null($key) ) {
    return app('settings')->get( $key );
  }
  else {
    return app('settings');
  }
}

function validator()
{
	return app('validator');
}

function router()
{
  return app('router');
}