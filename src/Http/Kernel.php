<?php

namespace Iboinas\Backoffice\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{


    /**
     * Addingo to the application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'sentinel.anyaccess' => \Iboinas\Backoffice\Http\Middleware\SentinelHasAnyAccess::class
    ];
}
