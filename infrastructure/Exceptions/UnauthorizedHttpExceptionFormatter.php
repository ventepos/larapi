<?php

namespace Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\HttpExceptionFormatter;

class UnauthorizedHttpExceptionFormatter extends HttpExceptionFormatter
{
	public function format(JsonResponse $response, Exception $e, array $reporterResponses)
	{
		parent::format($response, $e, $reporterResponses);

		$header = 'Bearer';
		$headers = $e->getHeaders();
		if (array_key_exists('WWW-Authenticate', $headers)) {
			$header = $headers['WWW-Authenticate'];
		}

		$response->headers->set('WWW-Authenticate', $header);
		return $response;
	}
}
