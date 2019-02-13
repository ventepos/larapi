<?php

namespace Infrastructure\Http\Middleware;

use Closure;
use Log;

class RequestId
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Log::debug('All da headers', ['headers' => $request->header()]);

		$extra = [];
		$rid = $request->header('x-request-id');
		$extra['request_id'] = $rid;

		$cip = $request->getClientIp();
		$xff = $request->header('x-forwarded-for');
		$xrip = $request->header('x-real-ip');

		if (! empty($xff)) {
			$cip = $xff;
		}
		else if (! empty($xrip)) {
			$cip = $xrip;
		}

		$extra['client_ip'] = $cip;

		$request->request->add($extra);

		// $this->app->bind('request_id', function ($app) use ($rid) {
		// 	return $rid;
		// });

		$rsp = $next($request);
		$rsp->headers->set('X-Request-Id', $rid);
		return $rsp;
	}
}
