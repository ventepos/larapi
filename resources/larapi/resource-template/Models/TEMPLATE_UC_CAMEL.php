<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TEMPLATE_UC_CAMEL extends Model
{
	protected $keyType = 'string';
	public $table = 'TEMPLATE_LC_SNAKE';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'user_id', // of the owner
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [

	];
}
