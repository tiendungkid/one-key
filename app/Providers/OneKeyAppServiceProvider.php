<?php

namespace App\Providers;

use App\Services\AppServices\AppService;
use App\Services\AppServices\AppServiceImplementing;
use Illuminate\Support\ServiceProvider;

class OneKeyAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $services = [
            AppService::class => AppServiceImplementing::class
        ];
        foreach ($services as $service => $implementing) {
            $this->app->bind($service, $implementing);
        }
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        //
    }
}
