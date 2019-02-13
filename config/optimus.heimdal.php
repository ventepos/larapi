<?php

use Symfony\Component\HttpKernel\Exception as SymfonyException;
use Optimus\Heimdal\Formatters;

return [
	'add_cors_headers' => false,

	// Has to be in prioritized order, e.g. highest priority first.
	'formatters' => [
		SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
		SymfonyException\UnauthorizedHttpException::class        => Infrastructure\Exceptions\UnauthorizedHttpExceptionFormatter::class,
		Infrastructure\Exceptions\UnauthorizedException::class   => Infrastructure\Exceptions\UnauthorizedHttpExceptionFormatter::class,
		Infrastructure\Exceptions\ForbiddenException::class      => Infrastructure\Exceptions\ForbiddenExceptionFormatter::class,
		Infrastructure\Exceptions\ImATeapotHttpException::class  => Infrastructure\Exceptions\ImATeapotHttpExceptionFormatter::class,
		SymfonyException\HttpException::class                    => Formatters\HttpExceptionFormatter::class,
		SymfonyException\UnprocessableEntityHttpException::class => Infrastructure\Exceptions\UnprocessableEntityHttpExceptionFormatter::class,
		Exception::class                                         => Formatters\ExceptionFormatter::class,
	],

	'response_factory' => \Optimus\Heimdal\ResponseFactory::class,

	'reporters' => [
		// 'sentry' => [
		//     'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
		//     'config' => [
		//         'dsn' => '',
		//         // For extra options see https://docs.sentry.io/clients/php/config/
		//         // php version and environment are automatically added.
		//         'sentry_options' => []
		//     ]
		// ]
	],

	'server_error_production' => 'An error occurred.'
];
