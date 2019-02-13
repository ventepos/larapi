<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL\Events;

use Infrastructure\Events\Event;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Models\TEMPLATE_UC_CAMEL;

class TEMPLATE_UC_CAMELWasUpdated extends Event
{
	public $TEMPLATE_LC_CAMEL;

	public function __construct(TEMPLATE_UC_CAMEL $TEMPLATE_LC_CAMEL)
	{
		$this->TEMPLATE_LC_CAMEL = $TEMPLATE_LC_CAMEL;
	}
}
