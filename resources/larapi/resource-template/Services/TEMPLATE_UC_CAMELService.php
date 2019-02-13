<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Exceptions\TEMPLATE_UC_CAMELNotFoundException;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasCreated;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasDeleted;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasUpdated;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Repositories\TEMPLATE_UC_CAMELRepository;

class TEMPLATE_UC_CAMELService
{
	private $auth;

	private $database;

	private $dispatcher;

	private $TEMPLATE_LC_CAMELRepository;

	public function __construct(
		AuthManager $auth,
		DatabaseManager $database,
		Dispatcher $dispatcher,
		TEMPLATE_UC_CAMELRepository $TEMPLATE_LC_CAMELRepository
	) {
		$this->auth = $auth;
		$this->database = $database;
		$this->dispatcher = $dispatcher;
		$this->TEMPLATE_LC_CAMELRepository = $TEMPLATE_LC_CAMELRepository;
	}

	public function getAll($options = [])
	{
		return $this->TEMPLATE_LC_CAMELRepository->get($options);
	}

	public function getById($TEMPLATE_LC_CAMELId, array $options = [])
	{
		$TEMPLATE_LC_CAMEL = $this->getRequestedTEMPLATE_UC_CAMEL($TEMPLATE_LC_CAMELId);

		return $TEMPLATE_LC_CAMEL;
	}

	public function create($data)
	{
		$account = $this->auth->user();

		// TODO: FIXME: https://github.com/Zizaco/entrust
		// Check if the User has permission to create other TEMPLATE_LC_CAMELs.
		// Will throw an exception if not.
		// $account->checkPermission('TEMPLATE_LC_CAMELs.create');

		$TEMPLATE_LC_CAMEL = $this->TEMPLATE_LC_CAMELRepository->create($data);

		$this->dispatcher->fire(new TEMPLATE_UC_CAMELWasCreated($TEMPLATE_LC_CAMEL));

		return $TEMPLATE_LC_CAMEL;
	}

	public function update($TEMPLATE_LC_CAMELId, array $data)
	{
		$TEMPLATE_LC_CAMEL = $this->getRequestedTEMPLATE_UC_CAMEL($TEMPLATE_LC_CAMELId);

		$this->TEMPLATE_LC_CAMELRepository->update($TEMPLATE_LC_CAMEL, $data);

		$this->dispatcher->fire(new TEMPLATE_UC_CAMELWasUpdated($TEMPLATE_LC_CAMEL));

		return $TEMPLATE_LC_CAMEL;
	}

	public function delete($TEMPLATE_LC_CAMELId)
	{
		$TEMPLATE_LC_CAMEL = $this->getRequestedTEMPLATE_UC_CAMEL($TEMPLATE_LC_CAMELId);

		$this->TEMPLATE_LC_CAMELRepository->delete($TEMPLATE_LC_CAMELId);

		$this->dispatcher->fire(new TEMPLATE_UC_CAMELWasDeleted($TEMPLATE_LC_CAMEL));
	}

	private function getRequestedTEMPLATE_UC_CAMEL($TEMPLATE_LC_CAMELId)
	{
		$TEMPLATE_LC_CAMEL = $this->TEMPLATE_LC_CAMELRepository->getById($TEMPLATE_LC_CAMELId);

		if (is_null($TEMPLATE_LC_CAMEL)) {
			throw new TEMPLATE_UC_CAMELNotFoundException();
		}

		return $TEMPLATE_LC_CAMEL;
	}
}
