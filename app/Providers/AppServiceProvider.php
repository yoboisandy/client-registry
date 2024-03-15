<?php

namespace App\Providers;

use App\Services\ClientService;
use App\Services\ClientServiceInterface;
use App\Services\CSVService;
use App\Services\CSVServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(ClientServiceInterface::class, ClientService::class);
        $this->app->singleton(CSVServiceInterface::class, CSVService::class);
    }
}
