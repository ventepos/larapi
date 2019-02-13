<?php

namespace Infrastructure\Passport;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;

class PassportMigrationServiceProvider extends ServiceProvider
{
	/**
	* Register any authentication / authorization services.
	*
	* @return void
	*/
	public function register()
	{
		Passport::ignoreMigrations();
	}
}
