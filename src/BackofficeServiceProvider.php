<?php

namespace Iboinas\Backoffice;

use Illuminate\Support\ServiceProvider;

class BackofficeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
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




        $this->loadViewsFrom($packagePath.'/views', 'Backoffice');



    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}