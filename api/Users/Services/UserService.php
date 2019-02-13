<?php

namespace Api\Users\Services;

use Log;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\UserRepository;

class UserService
{
	private $auth;

	private $database;

	private $dispatcher;

	private $userRepository;

	public function __construct(
		AuthManager $auth,
		DatabaseManager $database,
		Dispatcher $dispatcher,
		UserRepository $userRepository
	) {
		$this->auth = $auth;
		$this->database = $database;
		$this->dispatcher = $dispatcher;
		$this->userRepository = $userRepository;
	}

	public function getAll($options = [])
	{
		Log::debug('Fetching users', ['options' => $options]);
		return $this->userRepository->get($options);
	}

	public function getById($userId, array $options = [])
	{
		Log::debug('Fetching user', ['userId' => $userId, 'options' => $options]);
		$user = $this->getRequestedUser($userId);

		return $user;
	}

	public function create($data)
	{
		// $account = $this->auth->getCurrentUser();
		// dd($account->id);

		// Check if the user has permission to create other users.
		// Will throw an exception if not.
		// $account->checkPermission('users.create');

		$user = $this->userRepository->create($data);
		Log::info('Created user', ['userId' => $user->id]);

		$this->dispatcher->fire(new UserWasCreated($user));

		return $user;
	}

	public function update($userId, array $data)
	{
		$user = $this->getRequestedUser($userId);

		$this->userRepository->update($user, $data);
		Log::info('Updated user', ['userId' => $userId]);

		$this->dispatcher->fire(new UserWasUpdated($user));

		return $user;
	}

	public function delete($userId)
	{
		$user = $this->getRequestedUser($userId);

		$this->userRepository->delete($userId);
		Log::info('Deleted user', ['userId' => $userId]);

		$this->dispatcher->fire(new UserWasDeleted($user));
	}

	private function getRequestedUser($userId)
	{
		$user = $this->userRepository->getById($userId);

		if (is_null($user)) {
			throw new UserNotFoundException();
		}

		return $user;
	}
}
