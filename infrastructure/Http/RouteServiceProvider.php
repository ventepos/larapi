<?php

namespace Infrastructure\Http;

use Illuminate\Routing\Router;
use Optimus\Api\System\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);

        // use if primary keys are UUID
        // $router->pattern('id', '(?:[0-9]+)|(?:[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})');

        parent::boot($router);
    }
}
