<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ConfigurationRepository;

class ConfigurationServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('settings', function(){
			return new ConfigurationRepository;
		});
	}
}