<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL\Repositories;

use Api\TEMPLATE_UC_PLURAL_CAMEL\Models\TEMPLATE_UC_CAMEL;
use Infrastructure\Database\Eloquent\Repository;

class TEMPLATE_UC_CAMELRepository extends Repository
{
	public function getModel()
	{
		return new TEMPLATE_UC_CAMEL();
	}

	public function create(array $data)
	{
		$TEMPLATE_LC_CAMEL = $this->getModel();

		$TEMPLATE_LC_CAMEL->fill($data);
		$TEMPLATE_LC_CAMEL->save();

		return $TEMPLATE_LC_CAMEL;
	}

	public function update(TEMPLATE_UC_CAMEL $TEMPLATE_LC_CAMEL, array $data)
	{
		$TEMPLATE_LC_CAMEL->fill($data);
		$TEMPLATE_LC_CAMEL->save();

		return $TEMPLATE_LC_CAMEL;
	}
}
