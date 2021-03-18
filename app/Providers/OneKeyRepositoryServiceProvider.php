<?php

namespace App\Providers;

use App\Repositories\AccountRepository\AccountRepository;
use App\Repositories\AccountRepository\AccountRepositoryEloquent;
use App\Repositories\AppServiceRepository\AppServiceRepository;
use App\Repositories\AppServiceRepository\AppServiceRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class OneKeyRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $repositories = [
            AccountRepository::class => AccountRepositoryEloquent::class,
            AppServiceRepository::class => AppServiceRepositoryEloquent::class
        ];
        foreach ($repositories as $repository => $eloquent) {
            $this->app->bind($repository, $eloquent);
        }
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
    }
}
