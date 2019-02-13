<?php

namespace Infrastructure\Api\Controllers;

use Log;
use Infrastructure\Http\Controller as BaseController;
use Infrastructure\Version;

class DefaultApiController extends BaseController
{
    public function index()
    {
        Log::info('Resolving version');

        return response()->json([
            'title'   => sprintf('%s API', config('app.name')),
            'version' => Version::getGitTag(),
            'request_id' => request()->get('request_id'),
        ]);
    }
}
