<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL;

use Infrastructure\Services\Provider;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Services\TEMPLATE_UC_CAMELService;

class TEMPLATE_UC_CAMELServiceProvider extends Provider
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
		$this->app->singleton('TEMPLATE_UC_CAMELService', function ($app) {
			return $app->make(TEMPLATE_UC_CAMELService::class);
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
			'TEMPLATE_UC_CAMELService',
		];
	}
}
