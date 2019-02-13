<?php

namespace Infrastructure\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Optimus\Genie\Repository as BaseRepository;

abstract class Repository extends BaseRepository
{
	/**
	 * Get first resource by multiple where clauses
	 * @param  array  $clauses
	 * @param  array $options
	 * @return Resource
	 */
	public function firstWhereArray(array $clauses, array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		$query->where($clauses);

		return $query->first();
	}

	/**
	 * Get first resource that matches a given column and value
	 * @param  string $column
	 * @param  mixed $value
	 * @param  array $options
	 * @return Resource
	 */
	public function firstWhere($column, $value, array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		$query->where($column, $value);

		return $query->first();
	}

	/**
	 * Get first resource
	 * @param  string $column
	 * @param  mixed $value
	 * @param  array $options
	 * @return Resource
	 */
	public function first(array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		return $query->first();
	}

	/**
	 * Count the number of records where a column and value match truthy test
	 * @param  mixed $id
	 * @return void
	 */
	public function countWhere($column, $value)
	{
		$query = $this->createQueryBuilder();

		$query->where($column, $value);
		return $query->count();
	}

	/**
	 * Pluck a column from a list of resources
	 * @param  array $options
	 * @return Collection
	 */
	public function pluck($column, array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		return $query->pluck($column);
	}

	/**
	 * Get the max
	 * @param  array $options
	 * @return string
	 */
	public function max($column, array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		return $query->max($column);
	}

	/**
	 * Get the max with trased rows included
	 * @param  array $options
	 * @return string
	 */
	public function maxWithTrashed($column, array $options = [])
	{
		$query = $this->createBaseBuilder($options);

		return $query->withTrashed()->max($column);
	}
}
