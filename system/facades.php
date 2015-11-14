<?php
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

function form()
{
  return app('form');
}

function html()
{
  return app('html');
}

function session()
{
  return app('session');
}

function db()
{
	return app('db');
}

function validator()
{
	return app('validator');
}