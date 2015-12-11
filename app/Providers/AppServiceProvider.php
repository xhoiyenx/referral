<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ConfigurationRepository;

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
}