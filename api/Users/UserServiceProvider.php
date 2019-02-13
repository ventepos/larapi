<?php

namespace Api\Users;

use Infrastructure\Services\Provider;
use Api\Users\Services\UserService;

class UserServiceProvider extends Provider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerSingleton();
	}

	/**
	 * Register the singleton instance.
	 *
	 * @return void
	 */
	protected function registerSingleton()
	{
		$this->app->singleton('UserService', function ($app) {
			return $app->make(UserService::class);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'UserService',
		];
	}
}
