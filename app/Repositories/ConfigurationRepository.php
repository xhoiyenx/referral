<?php
namespace App\Repositories;
use App\Models\Configuration;

class ConfigurationRepository
{
	protected $autoloaded;

	public function __construct()
	{
		$this->autoloaded = $this->all();
	}

	public function save( $input )
	{
		foreach ( $input as $key => $val )
		{
      $meta_old = ['name' => $key];
      $meta_new = ['name' => $key, 'value' => $val];
      $config = Configuration::updateOrCreate($meta_old, $meta_new);
		}

		# WONT EXPECTING ANY ERRORS
		return true;
	}

	public function all()
	{
		return Configuration::lists('value', 'name');
	}

	public function get( $key, $default = null )
	{
		# SEARCH FROM AUTOLOADED CONFIG
		if ( isset( $this->autoloaded[$key] ) ) {
			if ( empty( $this->autoloaded[$key] ) ) {
				return (string) $default;
			}
			else {
				return $this->autoloaded[$key];
			}
		}
		# SEARCH FROM DB
		else {
			$config = Configuration::find( $key );
			if ( $config ) {
				if ( empty( $config->value ) ) {
					return (string) $default;
				}
				else {
					return (string) $config->value;
				}
			}
		}

		return '';
	}
}