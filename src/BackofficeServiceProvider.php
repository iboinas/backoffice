<?php

namespace Iboinas\Backoffice;

use Illuminate\Support\ServiceProvider;

class BackofficeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $packageFilename = with(new \ReflectionClass('Iboinas\Backoffice\BackofficeServiceProvider'))->getFileName();
        $packagePath     = dirname($packageFilename);

        // Should we register the default routes?
        if (config('sentinel.routes_enabled') || 1)
        {
            include $packagePath . '/Http/routes.php';
        }




    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
