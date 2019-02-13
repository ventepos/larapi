<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateUserRequest extends ApiRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'user' => 'array|required',
			'user.email' => 'required|email',
			'user.password' => 'required|string|min:8',
			'user.name_first' => 'required|string',
			'user.name_last' => 'required|string',
		];
	}

	public function attributes()
	{
		return [
			'user.email' => 'The User\'s email',
		];
	}
}
