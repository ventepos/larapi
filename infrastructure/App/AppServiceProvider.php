<?php

namespace Infrastructure\App;

use Log;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	private $appQueryCount = 0;

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		// uuid
		//
		Validator::extend('uuid', function($attribute, $value, $parameters, $validator){
			$matches = preg_match(
				'/(?:[0-9]+)|(?:[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})/',
				$value
			);

			return (bool) $matches;
		});

		$ac = $this->app['config'];
		if ($ac['app.env'] === 'local' && $ac['app.debug'] && $ac['app.debug_sql']) {
			DB::listen(function($query) {
				Log::debug("Executed SQL", [
					'sql' => $query->sql,
					'bindings' => $query->bindings,
					'time' => $query->time,
					'queryCount' => ++$this->appQueryCount,
					// 'connection' => $query->connection->name,
				]);
			});
		}

		$monolog = Log::getLogger();
		$monolog->pushProcessor(function ($record) {
			$rid = request()->get('request_id');

			if ($rid)
				$record['extra']['request_id'] = $rid;

			$record['extra']['user'] = (Auth::user() ? Auth::user()->id : null);
			$record['extra']['ip'] = request()->get('client_ip');

			return $record;
		});
	}
}
