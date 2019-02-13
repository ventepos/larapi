<?php

namespace Infrastructure\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
	public function __construct(\Exception $previous = null, $code = 0)
	{
		parent::__construct(401, $previous ? $previous->getMessage() : 'Unauthorized.', $previous, [], $code);
	}
}
