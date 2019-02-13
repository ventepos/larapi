<?php

namespace Infrastructure\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenException extends HttpException
{
	public function __construct(\Exception $previous = null, $code = 0)
	{
		parent::__construct(403, $previous ? $previous->getMessage() : 'Forbidden.', $previous, [], $code);
	}
}
