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
  return app('response');
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

function validator()
{
	return app('validator');
}

function router()
{
  return app('router');
}