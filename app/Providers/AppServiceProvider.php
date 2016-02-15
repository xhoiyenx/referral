<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ConfigurationRepository;
use App\Repositories\LeadRepository;

class AppServiceProvider extends ServiceProvider
{
	public function register()
	{
		/**
		 * Bind configuration module as global
		 */
		$this->app->singleton('settings', function(){
			return new ConfigurationRepository;
		});

	}

	public function boot()
	{
		/**
		 * Register new validation rules
		 */		
		$this->app['validator']->extend('passcheck', function ($attribute, $value, $parameters) 
		{
		  return app('hash')->check($value, auth()->member()->user()->getAuthPassword());
		});

		$this->app['validator']->extend('leadcheck', function ($attribute, $value, $parameters) 
		{
			$lead = $this->app->make( 'App\Repositories\LeadRepository' );
		  if ( $lead->leadCheck( $value ) ) {
		  	return false;
		  }
		  else {
		  	return true;
		  }
		});
	}
}