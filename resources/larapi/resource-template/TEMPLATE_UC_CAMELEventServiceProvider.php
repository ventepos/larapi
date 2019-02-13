<?php

namespace Api\TEMPLATE_UC_PLURAL_CAMEL;

use Infrastructure\Events\EventServiceProvider;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasCreated;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasDeleted;
use Api\TEMPLATE_UC_PLURAL_CAMEL\Events\TEMPLATE_UC_CAMELWasUpdated;

class TEMPLATE_UC_CAMELEventServiceProvider extends EventServiceProvider
{
	protected $listen = [
		TEMPLATE_UC_CAMELWasCreated::class => [
			// listeners for when a TEMPLATE_LC_CAMEL is created
		],
		TEMPLATE_UC_CAMELWasDeleted::class => [
			// listeners for when a TEMPLATE_LC_CAMEL is deleted
		],
		TEMPLATE_UC_CAMELWasUpdated::class => [
			// listeners for when a TEMPLATE_LC_CAMEL is updated
		]
	];
}
