<?php

namespace Infrastructure\Console;

use Exception;
use Illuminate\Console\Command;

class AddResourceCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'larapi:add-resource {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Adds a new larapi resource';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		if (config('app.env') === 'production') {
			throw new Exception('Will not create resource in production!');
		}
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$name = str_singular($this->argument('name'));

		$this->line(sprintf('Creating Resource: %s', $name));

		$names = [
			'uc_camel' => ucfirst(camel_case($name)),
			'uc_camel_plural' => str_plural(ucfirst(camel_case($name))),

			'lc_camel' => lcfirst(camel_case($name)),
			'lc_camel_plural' => str_plural(lcfirst(camel_case($name))),

			'lc_snake' => lcfirst(snake_case($name)),
			'lc_snake_plural' => str_plural(lcfirst(snake_case($name))),
		];

		$templatePath = resource_path('larapi/resource-template');
		$path = base_path(sprintf('api/%s', $names['uc_camel_plural']));

		shell_exec("cp -r $templatePath $path");

		shell_exec("find $path -type f -print0 | xargs -0 rename 's/TEMPLATE_UC_CAMEL/${names['uc_camel']}/'");
		shell_exec("find $path -type f -print0 | xargs -0 rename 's/TEMPLATE_UC_PLURAL_CAMEL/${names['uc_camel_plural']}/'");

		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_UC_CAMEL/${names['uc_camel']}/g'");
		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_LC_CAMEL/${names['lc_camel']}/g'");
		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_LC_SNAKE/${names['lc_snake']}/g'");

		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_UC_PLURAL_CAMEL/${names['uc_camel_plural']}/g'");
		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_LC_PLURAL_CAMEL/${names['lc_camel_plural']}/g'");
		shell_exec("find $path -type f -print0 | xargs -0 sed -i '' 's/TEMPLATE_LC_PLURAL_SNAKE/${names['lc_snake_plural']}/g'");

		$this->info('SUCCESS');
	}
}
