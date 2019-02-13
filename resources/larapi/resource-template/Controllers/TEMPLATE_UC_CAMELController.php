<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Requests\CreateTEMPLATE_UC_CAMELRequest;

class TEMPLATE_UC_CAMELController extends Controller
{
	private $TEMPLATE_LC_CAMELService;

	public function __construct()
	{
		$this->TEMPLATE_LC_CAMELService = app()->$TEMPLATE_LC_CAMELService;
	}

	public function getAll()
	{
		$resourceOptions = $this->parseResourceOptions();

		$data = $this->TEMPLATE_LC_CAMELService->getAll($resourceOptions);
		$parsedData = $this->parseData($data, $resourceOptions, 'TEMPLATE_LC_PLURAL_SNAKE');

		return $this->response($parsedData);
	}

	public function getById($TEMPLATE_LC_CAMELId)
	{
		$resourceOptions = $this->parseResourceOptions();

		$data = $this->TEMPLATE_LC_CAMELService->getById($TEMPLATE_LC_CAMELId, $resourceOptions);
		$parsedData = $this->parseData($data, $resourceOptions, 'TEMPLATE_LC_SNAKE');

		return $this->response($parsedData);
	}

	public function create(CreateTEMPLATE_UC_CAMELRequest $request)
	{
		$data = $request->get('TEMPLATE_LC_SNAKE', []);

		return $this->response($this->TEMPLATE_LC_CAMELService->create($data), 201);
	}

	public function update($TEMPLATE_LC_CAMELId, Request $request)
	{
		$data = $request->get('TEMPLATE_LC_SNAKE', []);

		return $this->response($this->TEMPLATE_LC_CAMELService->update($TEMPLATE_LC_CAMELId, $data));
	}

	public function delete($TEMPLATE_LC_CAMELId)
	{
		return $this->response($this->TEMPLATE_LC_CAMELService->delete($TEMPLATE_LC_CAMELId));
	}
}
