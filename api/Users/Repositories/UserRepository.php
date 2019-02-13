<?php

namespace Api\Users\Repositories;

use Api\Users\Models\User;
use Infrastructure\Database\Eloquent\Repository;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends Repository
{
	public function getModel()
	{
		return new User();
	}

	public function create(array $data)
	{
		$user = $this->getModel();

		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

		$user->fill($data);
		$user->save();

		return $user;
	}

	public function update(User $user, array $data)
	{
		$user->fill($data);

		$user->save();

		return $user;
	}

	// public function filterIsAgent(Builder $query, $method, $clauseOperator, $value, $in)
	// {
	//     // check if value is true
	//     if ($value) {
	//         $query->whereIn('roles.name', ['Agent']);
	//     }
	// }

	public function filterBrandId(Builder $query, $method, $clauseOperator, $value)
	{
		$bs = app()->make('BrandService');
		$brand = $bs->getById($value);

		$ss = app()->make('ShopService');
		$shops = $ss->getByBrandId($brand->id);
		$shopIDs = $shops->pluck('id');

		if (empty($shopIDs)) {
			throw new \Exception('Shops not found');
		}

		$sus = app()->make('ShopUserService');
		$shopUsers = $sus->getByShopIds($shopIDs->toArray());
		$userIDs = $shopUsers->pluck('user_id');

		call_user_func([$query, 'whereIn'], 'id', $userIDs);
	}

}
